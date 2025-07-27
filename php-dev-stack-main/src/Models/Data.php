<?php

namespace Models;

class Data
{
    private ?DataHeader $header;
    private array $rows;

    public function __construct(?DataHeader $header, array $rows)
    {
        $this->header = $header;
        $this->rows = $rows;
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