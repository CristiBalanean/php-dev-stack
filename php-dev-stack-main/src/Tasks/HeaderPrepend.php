<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Writer\CsvWriter;
use Services\HeaderPrependService;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'input.csv';
$header = explode(',', $argv[4]);

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new HeaderPrependService();
$service->prependHeader($writer, $data, $header);

echo "Header prepended" . PHP_EOL;

