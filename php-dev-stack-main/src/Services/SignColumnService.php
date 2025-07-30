<?php

namespace Services;

use Models\Data;
use Models\DataHeader;
use Models\DataRow;
use Writer\CsvWriter;

class SignColumnService
{
    public function signColumn(CsvWriter $writer, Data $data, string $columnToSign, string $privateKey, string $signatureColumn = 'Signature') : void
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        if ($header === null) 
        {
            throw new \Exception("Data must have a header to sign columns by name.");
        }

        $columns = $header->getColumns();
        $columns[] = $signatureColumn;
        $signedRows = [];

        $columnIndex = array_search($columnToSign, $header->getColumns());

        foreach($rows as $row)
        {
            $values = $row->getValues();
            $dataToSign = $values[$columnIndex] ?? '';
            openssl_sign($dataToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256);
            $values[] = base64_encode($signature);
            $signedRows[] = new DataRow($values);
        }

        $newHeader = new DataHeader($columns);
        $newData = new Data($newHeader, $signedRows);
        $writer->writeRows($newData);
    }
}