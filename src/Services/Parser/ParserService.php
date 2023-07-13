<?php

declare(strict_types=1);

namespace App\Services\Parser;

use App\Services\Parser\Exceptions\ParserException;

class ParserService
{
    private ParserFactory $factory;

    /**
     * @param ParserFactory $factory
     */
    public function __construct(ParserFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $file
     * @return array
     * @throws ParserException
     */
    public function read(string $file): array
    {
        $parser = $this->factory->create($file);

        return $parser->read($file);
    }
}
