<?php

namespace Writer;

use Writer\FileWriterInterface;
use Models\Data;

class CsvWriter implements FileWriterInterface
{
    private $fileLines;

    public function __construct(string $filePath)
    {
        $this->fileLines = fopen($filePath, 'w');
    }

    public function writeRows(Data $data): void
    {
        $header = $data->getHeader();
        if ($header !== null)
            fputcsv($this->fileLines, $header->getColumns());

        foreach ($data->getRows() as $row) 
        {
            fputcsv($this->fileLines, $row->getValues());
        }
    }

    public function close(): void
    {
        fclose($this->fileLines);
    }
}