<?php

namespace Services;

use Writer\CsvWriter;
use Models\Data;
use Models\DataHeader;

class HeaderPrependService
{
    public function prependHeader(CsvWriter $writer, Data $data, array $newHeader): void
    {
        $header = new DataHeader($newHeader);
        $writer->writeRows(new Data($header, $data->getRows()));
    }
}