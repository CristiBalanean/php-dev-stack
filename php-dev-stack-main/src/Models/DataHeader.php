<?php

namespace Models;

class DataHeader
{
    private array $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function prependColumn(string $columnName): void
    {
        array_unshift($this->columns, $columnName);
    }

    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->columns);
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function removeColumn(int $index): void
    {
        unset($this->columns[$index]);
        $this->columns = array_values($this->columns);
    }

    public function addColumn(string $columnName): void
    {
        $this->columns[] = $columnName;
    }
}