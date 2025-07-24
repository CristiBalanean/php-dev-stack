<?php

namespace CsvTools;

class CsvProcessor
{
    private CsvReader $reader;
    private string $outputPath;
    private $outputFile;

    public function __construct(string $inputPath, string $outputPath)
    {
        $this->reader = new CsvReader($inputPath);
        $this->outputPath = $outputPath;
        $this->outputFile = fopen($this->outputPath, 'w');
    }

    public function prependHeader(array $header): void
    {
        fputcsv($this->outputFile, $header);
        foreach ($this->reader->getRows() as $row) 
        {
            fputcsv($this->outputFile, $row);
        }
    }

    public function addIndexColumn(): void
    {
        $index = 1;
        foreach ($this->reader->getRows() as $row) 
        {
            $newRow = array_merge(["{$index}."], $row);
            fputcsv($this->outputFile, $newRow);
            $index++;
        }
    }

    public function finish(): void
    {
        fclose($this->outputFile);
    }
}