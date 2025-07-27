<?php

require __DIR__ . '/vendor/autoload.php';

$task = $argv[1] ?? null;
$args = array_slice($argv, 2);

switch ($task) 
{
    case 'prepend-header':
        require __DIR__ . '/src/Tasks/HeaderPrepend.php';
        break;
    default:
        echo "Unknown task: $task";
}