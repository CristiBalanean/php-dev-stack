<?php

namespace Services;

use Models\Data;
use Models\DataRow;
use Writer\CsvWriter;

class TruncateStringService
{
    public function truncateString(CsvWriter $writer, Data $data, string $column, int $length)
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        $columnIndex = array_search($column, $header->getColumns());

        foreach($rows as $row)
        {
            $values = $row->getValues();

            if(is_string($values[$columnIndex]))
            {
                $values[$columnIndex] = mb_substr($values[$columnIndex], 0, $length);
            }

            $truncatedRows[] = new DataRow($values);
        }

        $newData = new Data($header, $truncatedRows);
        $writer->writeRows($newData);
    }
}