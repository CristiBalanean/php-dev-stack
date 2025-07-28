<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Writer\CsvWriter;
use Services\IndexColumnsService;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new IndexColumnsService();
$service->addIndexColumn($writer, $data);

echo "Indexes added." . PHP_EOL;