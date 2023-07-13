<?php

namespace Test\Unit\Models;

use Test\TestCase;
use App\Models\Model;
use App\Models\Attributes as Attributes;

class ModelTest extends TestCase
{
    private FakeModel $model;

    protected function setUp(): void
    {
        $this->model = new FakeModel($this->getDatabaseConnection());
    }

    public function testGetTableName(): void
    {
         $this->assertEquals('fake_table', $this->model->getTableName());
    }

    public function testGetAttributes(): void
    {
        $attributes = [
            'name' => 'Alex',
            'city' => 'Cairo'
        ];
         $this->assertEquals($attributes, $this->model->getAttributes());
    }

    public function testBuildInsert(): void
    {
        $sql = 'INSERT INTO fake_table (name,city) VALUES (:name,:city)';
        $attributes = $this->model->getAttributes();

        $this->assertEquals($sql, $this->model->buildInsert($attributes));
    }
}

#[Attributes\Table('fake_table')]
class FakeModel extends Model
{
    #[Attributes\Column('name')]
    private string $name = 'Alex';
    #[Attributes\Column('city')]
    private string $city = 'Cairo';
}
