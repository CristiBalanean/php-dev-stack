<?php

require __DIR__ . '/../vendor/autoload.php';

use CsvTools\CsvProcessor;

// TO DO: handle incorrect file names
$inputPath = readline("Input file: ");
echo "Choose your option:" . PHP_EOL;
echo "1. Prepend header" . PHP_EOL;
echo "2. Add index" . PHP_EOL;
echo "3. Reorder header columns" . PHP_EOL;
echo "4. Column removal" . PHP_EOL;
echo "5. Truncate column values to length" . PHP_EOL;
$option = readline("Selection: ");

$processor = new CsvProcessor($inputPath);

switch ($option) {
    case '1':
        $headerInput = readline("Header attributes: ");
        $header = str_getcsv($headerInput);
        $processor->prependHeader($header);
        echo "Saved CSV with header." . PHP_EOL;
        break;

    case '2':
        $processor->addIndexColumn();
        echo "Saved CSV with index." . PHP_EOL;
        break;

    case '3':
        $reorderInput = readline("New header order: ");
        $newHeader = str_getcsv($reorderInput);
        $processor->reorderColumns($newHeader);
        echo "Reordered colums." . PHP_EOL;
        break;

    case '4':
        $columnToRemove = readline("Column name or index: ");
        $processor->removeColumn($columnToRemove);
        echo "Removed column" . PHP_EOL;
        break;

    case '5':
        echo "Truncated column to given length" . PHP_EOL;
        break;

    default:
        echo "Invalid option selected.\n";
        break;
}

$processor->finish();