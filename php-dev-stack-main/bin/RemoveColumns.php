<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Services\RemoveColumnService;
use Writer\CsvWriter;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$columnToRemove = $argv[4];

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new RemoveColumnService();
$service->removeColumn($writer, $data, $columnToRemove);

echo "Column removed" . PHP_EOL;