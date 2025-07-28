<?php

namespace Models;

class Data
{
    private ?DataHeader $header;
    /** @var DataRow[] */
    private array $rows;

    public function __construct(?DataHeader $header, array $rows)
    {
        $this->header = $header;
        $this->rows = $rows;
    }

    public static function hasHeader(array $lines): bool
    {
        if (empty($lines)) return false;

        $firstRow = str_getcsv($lines[0]);

        foreach ($firstRow as $value) 
        {
            if (is_numeric(trim($value))) 
                return false;
        }

        return true;
    }

    public function getHeader(): ?DataHeader
    {
        return $this->header;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}