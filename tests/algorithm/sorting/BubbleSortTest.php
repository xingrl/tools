<?php
namespace tests\algorithm\sorting;

use algorithm\sorting\BubbleSort;

require_once __DIR__. '/../../init.php';

$arr = BubbleSort::uniqueRandom(1, 100000, 5000);
$start = microtime(true);
BubbleSort::bubbleSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "V1 used $used s" . PHP_EOL;
//V1 used 1.6175799369812 s

$arr = BubbleSort::uniqueRandom(1, 100000, 5000);
$start = microtime(true);
BubbleSort::bubbleSortV2($arr);
$end = microtime(true);
$used = $end - $start;
echo "V2 used $used s" . PHP_EOL;
//V2 used 1.168995141983 s

$arr = BubbleSort::uniqueRandom(1, 100000, 5000);
$start = microtime(true);
BubbleSort::bubbleSortV3($arr);
$end = microtime(true);
$used = $end - $start;
echo "V3 used $used s" . PHP_EOL;
//V3 used 1.1077501773834 s

$arr = BubbleSort::uniqueRandom(1, 100000, 5000);
$start = microtime(true);
asort($arr);
$end = microtime(true);
$used = $end - $start;
echo "asort() used $used s" . PHP_EOL;
//asort() used 0.00070095062255859 s