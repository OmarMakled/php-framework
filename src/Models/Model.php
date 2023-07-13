<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use ReflectionClass;
use ReflectionProperty;
use ReflectionAttribute;
use App\Models\Attributes\Table;
use App\Models\Attributes\Column;
use App\Services\Database\DatabaseConnectionInterface;

class Model
{
    /**
     * @param DatabaseConnectionInterface $dbConn
     */
    public function __construct(private readonly DatabaseConnectionInterface $dbConn)
    {
    }

    /**
     * Fill model from the given data
     *
     * @param array $data
     * @return $this
     */
    public function fill(array $data): self
    {
        foreach ($data as $key => $val) {
            $fn = 'set' . ucfirst($key);
            if (method_exists($this, $fn)) {
                $this->{$fn}($val);
            }
        }

        return $this;
    }

    /**
     * Get table name from attribute
     *
     * @return string
     */
    public function getTableName(): string
    {
        return (new ReflectionClass($this))
            ->getAttributes(Table::class, ReflectionAttribute::IS_INSTANCEOF)[0]
            ->newInstance()
            ->name;
    }

    /**
     * Get model attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PRIVATE) as $prop) {
            foreach ($prop->getAttributes(Column::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $attributes[$attribute->newInstance()->name] = $prop->getValue($this);
            }
        }

        return $attributes;
    }

    /**
     * Build insert statement
     *
     * @param array $attributes
     * @return string
     */
    public function buildInsert(array $attributes): string
    {
        $columns = array_keys($attributes);
        $values = array_map(function ($val) {
            return ':' . $val;
        }, $columns);

        return sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(',', $columns),
            implode(',', $values)
        );
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $attributes = $this->getAttributes();
        $stmt = $this->dbConn->getPDO()->prepare($this->buildInsert($attributes));

        foreach ($attributes as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        $stmt->execute();
    }

    /**
     * @return array
     */
    public function selectAll(): array
    {
        return $this->dbConn->getPDO()
            ->query('SELECT * from ' . $this->getTableName())
            ->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param string $field
     * @param string $value
     * @return array
     */
    public function selectWhere(string $field, string $value): array
    {
        $stmt = $this->dbConn->getPDO()
            ->prepare('SELECT * FROM ' . $this->getTableName() . ' WHERE ' . $field . ' = :val');
        $stmt->bindValue(':val', $value);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
