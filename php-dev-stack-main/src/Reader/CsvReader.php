<?php

namespace Reader;

use Models\Data;
use Models\DataHeader;
use Models\DataRow;
use Reader\FileReaderInterface;

class CsvReader implements FileReaderInterface
{
    private $fileLines;

    public function __construct(string $filePath)
    {
        $this->fileLines = file($filePath);
    }

    public function getData(): Data
    {
        $lines = $this->fileLines;
        $rows = array_map(fn($line) => new DataRow(str_getcsv($line)), $lines);

        return new Data(null, $rows);
    }
}