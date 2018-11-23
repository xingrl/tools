<?php
namespace algorithm\sorting;

/**
 * 冒泡排序 PHP实现
 * 原理：两两相邻比较，如果反序就交换，否则不交换
 * 时间复杂度：最好 O(n) 最坏 O(n2) 平均 O(n2)
 * 空间复杂度：O(1)
 * 什么时候使用：当所有的数据位于单向链表中
 */
class BubbleSort
{
    public static function uniqueRandom($min, $max, $num)
    {
        $count = 0;
        $return = [];
        while($count < $num) {
            $return[] = mt_rand($min, $max);
            //去重
            $return = array_flip(array_flip($return));
            $count = count($return);
        }
        shuffle($return);
        return $return;
    }

    public static function bubbleSort(&$arr) : void
    {
        for ($i = 0, $c = count($arr); $i < $c; $i++) {
            $swapped = false;
            for ($j = 0; $j < $c - 1; $j++) {
                if ($arr[$j + 1] < $arr[$j]) {
                    list($arr[$j], $arr[$j + 1]) = array($arr[$j + 1], $arr[$j]);
                    $swapped = true;
                }
            }
            if (!$swapped) break; //没有发生交换，算法结束
        }
    }

    public static function bubbleSortV2(&$arr) : void
    {
        for ($i = 0, $c = count($arr); $i < $c; $i++) {
            $swapped = false;
            for ($j = 0; $j < $c - $i - 1; $j++) {
                if ($arr[$j + 1] < $arr[$j]) {
                    list($arr[$j], $arr[$j + 1]) = array($arr[$j + 1], $arr[$j]);
                    $swapped = true;
                }
            }
            if (!$swapped) break; //没有发生交换，算法结束
        }
    }

    public static function bubbleSortV3(&$arr) : void
    {
        $bound = count($arr) - 1;
        for ($i = 0, $c = count($arr); $i < $c; $i++) {
            $swapped = false;
            for ($j = 0; $j < $bound; $j++) {
                if ($arr[$j + 1] < $arr[$j]) {
                    list($arr[$j], $arr[$j + 1]) = array($arr[$j + 1], $arr[$j]);
                    $swapped = true;
                    $newBound = $j;
                }
            }
            $bound = $newBound;
            if (!$swapped) break; //没有发生交换，算法结束
        }
    }
}