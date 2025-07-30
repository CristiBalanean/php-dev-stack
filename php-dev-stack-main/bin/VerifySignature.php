<?php

require_once 'vendor/autoload.php';

use Reader\CsvReader;
use Writer\CsvWriter;
use Services\VerifySignatureService;

$input = $argv[2] ?? 'input.csv';
$output = $argv[3] ?? 'output.csv';
$columnToVerify = $argv[4];
$signatureColumn = $argv[5];
$keyFile = $argv[6];
$resultColumn = $argv[7];

$publicKey = file_get_contents($keyFile);

$reader = new CsvReader($input);
$data = $reader->getData();
$writer = new CsvWriter($output);

$service = new verifySignatureService();
$service->verifySignature($writer, $data, $columnToVerify, $signatureColumn, $publicKey, $resultColumn);

echo "Verification complete." . PHP_EOL;