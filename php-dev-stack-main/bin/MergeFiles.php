<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Services\MergeFilesService;
use Writer\CsvWriter;

$output = $argv[2] ?? 'output.csv';
$inputs = array_slice($argv, 3);

$datasets = [];

foreach($inputs as $input)
{
    $reader = new CsvReader($input);
    $data = $reader->getData();
    $datasets[] = $data;
}

$writer = new CsvWriter($output);

$service = new MergeFilesService();
$service->mergeFiles($writer, ...$datasets);

echo "Files merged" . PHP_EOL;