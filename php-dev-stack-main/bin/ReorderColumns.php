<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Writer\CsvWriter;
use Services\ReorderColumnsService;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$reorderedHeader = explode(',', $argv[4]);

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new ReorderColumnsService();
$service->reorderColumns($writer, $data, $reorderedHeader);

echo "Columns reordered" . PHP_EOL;

