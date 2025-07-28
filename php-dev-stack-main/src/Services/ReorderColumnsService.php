<?php

namespace Services;

use Models\Data;
use Models\DataHeader;
use Models\DataRow;
use Writer\CsvWriter;

class ReorderColumnsService
{
    public function reorderColumns(CsvWriter $writer, Data $data, array $newHeaderOrder): void
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        $originalHeader = $header->getColumns();
        $indexOrder = [];

        foreach($newHeaderOrder as $columnName)
        {
            $index = array_search($columnName, $originalHeader);
            if($index !== false)
                $indexOrder[] = $index;
        }

        $newHeader = new DataHeader($newHeaderOrder);
        $rowsReordered = [];

        foreach($rows as $row)
        {
            $rowReordered = [];
            foreach($indexOrder as $index)
            {
                $rowReordered[] = $row->getColumn($index);
            }
            $rowsReordered[] = new DataRow($rowReordered);
        }

        $newData = new Data($newHeader, $rowsReordered);
        $writer->writeRows($newData);
    }
}