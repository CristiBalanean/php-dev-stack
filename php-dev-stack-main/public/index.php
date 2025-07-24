<?php

require __DIR__ . '/../vendor/autoload.php';

use CsvTools\CsvProcessor;

// TO DO: handle incorrect file names
$inputPath = readline("Input file: ");
$outputPath = readline("Output file: ");
echo "Choose your option:" . PHP_EOL;
echo "1. Prepend header" . PHP_EOL;
echo "2. Add index" . PHP_EOL;
$option = readline("Selection: ");

$processor = new CsvProcessor($inputPath, $outputPath);

switch ($option) {
    case '1':
        $headerInput = readline("Header attributes: ");
        $header = str_getcsv($headerInput);
        $processor->prependHeader($header);
        echo "Saved CSV with header.\n";
        break;

    case '2':
        $processor->addIndexColumn();
        echo "Saved CSV with index.\n";
        break;

    case '3':
        $reorderInput = readline("New header order: ");
        break;

    default:
        echo "Invalid option selected.\n";
        break;
}

$processor->finish();