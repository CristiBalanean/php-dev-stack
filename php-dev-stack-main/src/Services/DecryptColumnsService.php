<?php

namespace Services;

use Models\Data;
use Models\DataRow;
use Writer\CsvWriter;

class DecryptColumnsService
{
    public function decryptColumns(CsvWriter $writer, Data $data, array $columnsToEncrypt, string $privateKey): void
    {
        $header = $data->getHeader();
        $rows = $data->getRows();

        if($header === null)
        {
            throw new \Exception("Data must have a header to decrypt columns by name.");
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

        $decryptedRows = [];
        foreach($rows as $row)
        {
            $values = $row->getValues();
            foreach($columnIndexes as $index)
            {
                if(isset($values[$index]))
                {
                    $encrypted = base64_decode($values[$index]);
                    openssl_private_decrypt($encrypted, $decrypted, $privateKey);
                    $values[$index] = $decrypted;
                }
            }
            $decryptedRows[] = new DataRow($values);
        }

        $newData = new Data($header, $decryptedRows);
        $writer->writeRows($newData);
    }
}