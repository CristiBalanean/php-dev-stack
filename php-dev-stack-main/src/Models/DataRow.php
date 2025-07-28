<?php

namespace Models;

class DataRow
{
    private array $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getValueIndex(int $index): mixed
    {
        return $this->values[$index] ?? null;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getColumn(int $index): mixed 
    {
        return $this->values[$index] ?? null;
    }
}