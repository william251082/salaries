<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 */

//Statistics

$start = microtime(true);

include 'autoload.php';

$process = new \Process\Process();
$process->start();

//Statistics
$end = microtime(true);

$elapsed = $end-$start;
$memUsage = memory_get_usage();
$usage = ($memUsage/1024)/1024;
$peakUsage = (memory_get_peak_usage()/1024)/1024;

echo 'Elapsed: '.round($elapsed, 2).' seconds'.PHP_EOL;
echo 'MemoryUsage: '.round($usage, 2).' MB'.PHP_EOL;
echo 'PeakMemoryUsage: '.round($peakUsage, 2).' MB'.PHP_EOL;
