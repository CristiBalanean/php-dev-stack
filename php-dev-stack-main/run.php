<?php

require __DIR__ . '/vendor/autoload.php';

$task = $argv[1] ?? null;
$args = array_slice($argv, 2);

switch ($task) 
{
    case 'prepend-header':
        require __DIR__ . '/bin/HeaderPrepend.php';
        break;

    case 'index-colums':
        require __Dir__ . '/bin/IndexColumns.php';
        break;

    case 'remove-column':
        require __DIR__ . '/bin/RemoveColumns.php';
        break;

    case 'reorder-columns':
        require __DIR__ . '/bin/ReorderColumns.php';
        break;

    case 'truncate-string':
        require __DIR__ . '/bin/TruncateString.php';
        break;

    case 'merge-files':
        require __DIR__ . '/bin/MergeFiles.php';
        break;

    case 'encrypt-files':
        require __DIR__ . '/bin/EncryptColumns.php';
        break;

    case 'decrypt-files':
        require __DIR__ . '/bin/DecryptColumns.php';
        break;

    case 'sign-column':
        require __DIR__ . '/bin/SignColumn.php';
        break;

    case 'verify-signature':
        require __DIR__ . '/bin/VerifySignature.php';
        break;

    default:
        echo "Unknown task: $task";
}