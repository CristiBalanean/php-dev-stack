<?php

namespace Services;

use Models\Data;
use Writer\CsvWriter;

class MergeFilesService
{
    public function mergeFiles(CsvWriter $writer, Data ...$datasets)
    {
        if(count($datasets) < 2) return;

        $baseHeader = $datasets[0]->getHeader();
        $mergedRows = [];

        foreach ($datasets as $index => $data)
        {
            $header = $data->getHeader();

            if ($baseHeader !== null && $header !== null && $baseHeader->getColumns() !== $header->getColumns()) 
                        throw new \Exception("Header mismatch in file index $index.");

            $mergedRows = array_merge($mergedRows, $data->getRows());
        }

        $mergedData = new Data($baseHeader, $mergedRows);
        $writer->writeRows($mergedData);
    }
}