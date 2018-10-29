<?php
namespace tests\algorithm\sort;

use algorithm\sort\QuickSort;

require_once __DIR__. '/../../init.php';

$arr=[6,3,8,6,4,2,9,5,1];

$r = QuickSort::getResult($arr);

print_r($r);