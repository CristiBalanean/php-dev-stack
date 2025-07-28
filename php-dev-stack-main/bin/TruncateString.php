<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Services\TruncateStringService;
use Writer\CsvWriter;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$column= $argv[4];
$length = $argv[5];

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new TruncateStringService();
$service->truncateString($writer, $data, $column, $length);

echo 'Truncated column to length' . PHP_EOL;