<?php

namespace Services;

use Models\Data;
use Models\DataHeader;
use Models\DataRow;
use Writer\CsvWriter;

class verifySignatureService
{
    public function verifySignature(CsvWriter $writer, Data $data, string $columnToVerify, string $signatureColumn, string $publicKey, string $resultColumn = 'Verification'): void
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        if ($header === null) 
        {
            throw new \Exception("Data must have a header to remove columns by name.");
        }

        $columns = $header->getColumns();
        $columns[] = $resultColumn;
        $newHeader = new DataHeader($columns);

        $columnIndex = array_search($columnToVerify, $header->getColumns());
        $signatureIndex = array_search($signatureColumn, $header->getColumns());

        $newRows = [];
        foreach ($rows as $row) 
        {
            $values = $row->getValues();
            $dataToVerify = $values[$columnIndex];
            $signature = base64_decode($values[$signatureIndex]);
            $isValid = openssl_verify($dataToVerify, $signature, $publicKey, OPENSSL_ALGO_SHA256) === 1;
            $values[] = $isValid ? 'Valid' : 'Invalid';
            $newRows[] = new DataRow($values);
        }

        $writer->writeRows(new Data($newHeader, $newRows));
    }
}