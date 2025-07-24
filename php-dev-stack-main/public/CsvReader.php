<?php

namespace CsvTools;

class CsvReader 
{
    private $fileLines;

    //TO-DO: use generators

    public function __construct(string $filePath)
    {
        $this->fileLines = file($filePath);
    }

    public function getRows(): array
    {
        $rows = [];
        foreach ($this->fileLines as $line) 
        {
            $rows[] = str_getcsv($line);
        }
        return $rows;
    }
}