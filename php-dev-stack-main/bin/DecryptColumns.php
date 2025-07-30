<?php

use Reader\CsvReader;
use Services\DecryptColumnsService;
use Services\DecryptFilesService;
use Services\EncryptColumnsService;
use Writer\CsvWriter;

require_once 'vendor/autoload.php';

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$columns = explode(',', $argv[4]);
$keyFile = $argv[5];

$privateKey = file_get_contents($keyFile);

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new DecryptColumnsService();
$service->decryptColumns($writer, $data, $columns, $privateKey);

echo "Decryption complete" . PHP_EOL;