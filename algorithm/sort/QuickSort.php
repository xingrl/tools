<?php
##
# 快速排序
# 核心思想：找出任意一个元素（比如第一个）作为标准；其他比对后，按大小放到2个数组里；递归直到数据元素为1
# 时间复杂度: O(nlogn)
##
namespace algorithm\sort;

class QuickSort
{
    public static function getResult($arr)
    {
        if (!is_array($arr) || !$arr) {
            return [];
        }

        if (count($arr) == 1) {
            return $arr;
        }

        $left = [];
        $right = [];

        for ($i=1; $i<count($arr); $i++) {
            if ($arr[$i] < $arr[0]) {
                $left[] = $arr[$i];
            }
            else {
                $right[] = $arr[$i];
            }
        }

        $left = self::getResult($left);
        $right = self::getResult($right);

        return array_merge($left, [$arr[0]], $right);
    }
}