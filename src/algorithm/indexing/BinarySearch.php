<?php
namespace algorithm\indexing;

class BinarySearch {
    /**
     * 二分查找
     * 思想：取中间位置的值比对；小于则移动左边位置到中间位置右侧；
     *
     * @param array $arr 从小到大排好序的数组
     * @param $searchValue 要查找的值
     *
     * @return int 找到的位置，-1为未找到
     */
    public static function getResult($arr, $searchValue)
    {
        $low = 0;
        $high = count($arr)-1;

        while ($low <= $high) {
            $middle = intval(floor(($low + $high) /2));

            if ($arr[$middle] == $searchValue) {
                return $middle;
            }
            else if ($arr[$middle] < $searchValue){
                $low = $middle + 1;
            }
            else {
                $high = $middle - 1;
            }
        }

        return -1;
    }
}