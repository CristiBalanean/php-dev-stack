<?php

namespace Services;

use Models\Data;
use Models\DataRow;
use Writer\CsvWriter;

class EncryptColumnsService
{
    public function encryptColumns(CsvWriter $writer, Data $data, array $columnsToEncrypt, string $publicKey): void
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        if($header === null)
        {
            throw new \Exception("Data must have a header to encrypt columns by name.");
        }

        $columnIndexes = [];
        foreach($columnsToEncrypt as $columnName)
        {
            $index = array_search($columnName, $header->getColumns());
            if($index !== false)
            {
                $columnIndexes[] = $index;
            }
        }

        $encryptedRows = [];
        foreach($rows as $row)
        {
            $values = $row->getValues();
            foreach($columnIndexes as $index)
            {
                if(isset($values[$index]))
                {
                    openssl_public_encrypt($values[$index], $encrypted, $publicKey);
                    $values[$index] = base64_encode($encrypted);
                }
            }
            $encryptedRows[] = new DataRow($values);
        }

        $newData = new Data($header, $encryptedRows);
        $writer->writeRows($newData);
    }
}