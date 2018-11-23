<?php
namespace algorithm\sort;

/**
 * 将待排序数组分配到若干个桶内，然后每个桶内再各自进行排序，桶内的排序可以使用不同的算法，比如插入排序或快速排序，属于分治法。每个桶执行完排序后，最后依次将每个桶内的有序序列拿出来，即得到完整的排序结果。
 *
 * Class BucketSort
 * @package algorithm\sort
 */
class BucketSort
{
    public static function bucketSort(array &$data)
    {
        $bucketLen = max($data) - min($data) + 1;
        $bucket = array_fill(0, $bucketLen, []);
        for ($i = 0; $i < count($data); $i++) {
            array_push($bucket[$data[$i] - min($data)], $data[$i]);
        }
        $k = 0;
        for ($i = 0; $i < $bucketLen; $i++) {
            $currentBucketLen = count($bucket[$i]);
            for ($j = 0; $j < $currentBucketLen; $j++) {
                $data[$k] = $bucket[$i][$j];
                $k++;
            }
        }
    }

    public static function randomArr($min, $max, $num, $sorted = false, $isUnique = false)
    {
        $count = 0;
        $return = [];
        while($count < $num) {
            $return[] = mt_rand($min, $max);
            if ($isUnique) {
                $return = array_flip(array_flip($return));
            }
            $count = count($return);
        }
        if ($sorted) sort($return);
        return $return;
    }
}