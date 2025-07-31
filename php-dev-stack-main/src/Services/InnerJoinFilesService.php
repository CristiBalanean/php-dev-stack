<?php

namespace Services;

use Models\Data;
use Models\DataHeader;
use Models\DataRow;
use Writer\CsvWriter;

class InnerJoinFilesService
{
    public function innerJoin(CsvWriter $writer, Data $dataLeft, Data $dataRight, string $leftKey, string $rightKey) : void
    {
        $leftHeader = $dataLeft->getHeader();
        $rightHeader = $dataRight->getHeader();

        $leftColumns = $leftHeader->getColumns();
        $rightColumns = $rightHeader->getColumns();

        $leftIndex = array_search($leftKey, $leftColumns);
        $rightIndex = array_search($rightKey, $rightColumns);

        $rightColumnsFiltered = $rightColumns;
        unset($rightColumnsFiltered[$rightIndex]);
        $rightColumnsFiltered = array_values($rightColumnsFiltered);

        $outputHeader = array_merge($leftColumns, $rightColumnsFiltered);
        $header = new DataHeader($outputHeader);


        $rightRows = [];
        foreach($dataRight->getRows() as $row)
        {
            $key = $row->getValueIndex($rightIndex);
            $rightRows[$key][] = $row;
        }

        $joinedRows = [];
        foreach($dataLeft->getRows() as $leftRow)
        {
            $leftValue = $leftRow->getValueIndex($leftIndex);
            if(isset($rightRows[$leftValue]))
            {
                foreach($rightRows[$leftValue] as $rightRow)
                {
                    $rightValues = $rightRow->getValues();
                    unset($rightValues[$rightIndex]);
                    $rightValues = array_values($rightValues);

                    $newRow = array_merge($leftRow->getValues(), $rightValues);
                    $joinedRows[] = new DataRow($newRow);
                }
            }
        }

        $newData = new Data($header, $joinedRows);
        $writer->writeRows($newData);
    }
}