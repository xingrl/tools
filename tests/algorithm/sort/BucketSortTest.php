<?php
namespace tests\algorithm\sort;

use algorithm\sort\BucketSort;

require_once __DIR__. '/../../init.php';


$arr = BucketSort::randomArr(1, 100, 50);
$start = microtime(true);
BucketSort::bucketSort($arr);
$end = microtime(true);
$used = $end - $start;
echo "bucketSort used $used s" . PHP_EOL;

