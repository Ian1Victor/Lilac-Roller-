<?php

function logError($e){
    $filePath = dirname(dirname(__DIR__)).'\\log.txt';
    $file = fopen($filePath, 'a');
    $errorStr = '---------------------Caugth Exception-----------------'.PHP_EOL;
    $errorStr .= 'Message: '. $e->getMessage().PHP_EOL;
    $errorStr .= 'Stack Trace: ' .PHP_EOL;
    $errorStr .= $e->getTraceAsString();
    $errorStr .= "\nthrown " . $e->getFile() . "\n\n";
    fwrite($file, $errorStr);
    fclose($file);
}