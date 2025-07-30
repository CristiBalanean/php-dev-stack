<?php

use Reader\CsvReader;
use Services\SignColumnService;
use Writer\CsvWriter;

require_once 'vendor/autoload.php';

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$columnToSign = $argv[4];
$keyFile = $argv[5];
$signatureColumn = $argv[6];

$privateKey = file_get_contents($keyFile);

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new SignColumnService();
$service->signColumn($writer, $data, $columnToSign, $privateKey, $signatureColumn);

echo "Signing complete" . PHP_EOL;
