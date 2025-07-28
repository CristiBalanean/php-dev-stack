<?php

namespace Services;

use Writer\CsvWriter;
use Models\Data;
use Models\DataRow;

class IndexColumnsService
{
    public function addIndexColumn(CsvWriter $writer, Data $data): void
    {
        $indexedRows = [];
        $index = 1;
        $rows = $data->getRows();

        foreach($rows as $row)
        {
            $values = $row->getValues();
            $indexedValues = array_merge([$index++], $values);
            $indexedRows[] = new DataRow($indexedValues);
        }

        $header = $data->getHeader();
        if($header != null)
            $header->prependColumn("Index");

        $newData = new Data($header, $indexedRows);
        $writer->writeRows($newData);
    }
}