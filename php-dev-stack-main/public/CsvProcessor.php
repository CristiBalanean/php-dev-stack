<?php

namespace CsvTools;

class CsvProcessor
{
    private CsvReader $reader;
    private string $inputPath;
    private $inputFile;

    public function __construct(string $inputPath)
    {
        $this->inputPath = $inputPath;
        $this->reader = new CsvReader($inputPath);
        $this->inputFile = fopen($this->inputPath, 'w');
    }

    public function prependHeader(array $header): void
    {
        fputcsv($this->inputFile, $header);
        foreach ($this->reader->getRows() as $row) 
        {
            fputcsv($this->inputFile, $row);
        }
    }

    //Dont add index to header
    public function addIndexColumn(): void
    {
        $index = 1;
        foreach ($this->reader->getRows() as $row) 
        {
            $newRow = array_merge(["{$index}."], $row);
            fputcsv($this->inputFile, $newRow);
            $index++;
        }
    }

    public function reorderColumns(array $newHeaderOrder): void
    {
        $rows = $this->reader->getRows();
        $originalHeader = array_map('trim', array_shift($rows));
        $newHeaderOrder = array_map('trim', $newHeaderOrder); 

        $indexOrder = [];
        foreach($newHeaderOrder as $headerName)
        {
            $index = array_search($headerName, $originalHeader);
            if($index !== false)
            {
                $indexOrder[] = $index;
            }
            else
            {
                //TO-DO: handle headers that dont match
            }
        }

        fputcsv($this->inputFile, $newHeaderOrder);
        foreach($rows as $row)
        {
            $rowReordered = [];
            foreach($indexOrder as $index)
            {
                $rowReordered[] = $row[$index];
            }
            fputcsv($this->inputFile, $rowReordered);
        }
    }

    //TO-DO: check if columnIndex doesnt exist
    public function removeColumn(string $columnToRemove): void
    {
        $rows = $this->reader->getRows();
        $originalHeader = array_shift($rows);

        $columnIndex = null;
        if(is_numeric($columnToRemove))
        {
            $columnIndex = (int)$columnToRemove - 1;
        }
        else
        {
            $columnIndex = array_search($columnToRemove, $originalHeader);
        }

        unset($originalHeader[$columnIndex]);
        fputcsv($this->inputFile, array_values($originalHeader));
        foreach($rows as $row)
        {
            unset($row[$columnIndex]);
            fputcsv($this->inputFile, array_values($row));
        }
    }

    public function finish(): void
    {
        fclose($this->inputFile);
    }
}