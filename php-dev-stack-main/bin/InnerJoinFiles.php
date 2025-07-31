<?php

use Reader\CsvReader;
use Services\InnerJoinFilesService;
use Writer\CsvWriter;

require_once 'vendor/autoload.php';

$inputLeft = $argv[2];
$inputRight = $argv[3];
$output = $argv[4] ?? 'output.csv';
$leftKey = $argv[5];
$rightKey = $argv[6];

$leftReader = new CsvReader($inputLeft);
$rightReader = new CsvReader($inputRight);

$leftData = $leftReader->getData();
$rightData = $rightReader->getData();

$writer = new CsvWriter($output);

$service = new InnerJoinFilesService();
$service->innerJoin($writer, $leftData, $rightData, $leftKey, $rightKey);

echo "Join complete" . PHP_EOL;