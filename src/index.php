<?php

require './vendor/autoload.php';

use Olawuyiayansola\Recursion\FileReaderInterface;
use Olawuyiayansola\Recursion\FileReader;
use Olawuyiayansola\Recursion\NumberProcessor;

$fileReader = new FileReader();

$directory = dirname(__FILE__).'/';

$numberProcessor = new NumberProcessor($fileReader, $directory);

$results = $numberProcessor->sumNumberInFiles('text.txt');

foreach($results as $file => $sum) {
    echo $file. ' - '. $sum. PHP_EOL;
}