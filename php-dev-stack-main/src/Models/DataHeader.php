<?php

namespace Models;

class DataHeader
{
    private array $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function getColumnIndex(string $name): int
    {
        return $index = array_search($name, $this->columns);
    }

    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->columns);
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}