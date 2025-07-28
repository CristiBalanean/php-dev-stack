<?php

namespace Services;

use Models\Data;
use Writer\CsvWriter;

class RemoveColumnService
{
    public function removeColumn(CsvWriter $writer, Data $data, string $columnToRemove)
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        $columnIndex = null;
        if(is_numeric($columnToRemove))
        {
            $columnIndex = (int)$columnToRemove - 1;
        }
        else
        {
            $columnIndex = array_search($columnToRemove, $header->getColumns());
        }

        $header->removeColumn($columnIndex);
        foreach($rows as $row)
        {
            $row->removeColumn($columnIndex);
        }

        $newData = new Data($header, $rows);
        $writer->writeRows($newData);
    }
}