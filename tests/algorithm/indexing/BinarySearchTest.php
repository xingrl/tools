<?php
/**
 * Created by PhpStorm.
 * User: xingwenge
 * Date: 2018/11/23
 * Time: 16:56
 */

namespace tests\algorithm\indexing;

use algorithm\indexing\BinarySearch;
use PHPUnit\Framework\TestCase;

class BinarySearchTest extends TestCase
{
    public function getData()
    {
        return [ # [sortArr, searchValue, expectReturnIndex]
            [ [1, 3, 5, 7, 9], 7, 3 ],
            [ [1, 3, 5, 7, 9], 3, 1 ],
            [ [1, 3, 5, 7, 9], 4, -1 ],
        ];
    }

    /**
     * @dataProvider getData
     *
     * @param $sortArr
     * @param $searchValue
     * @param $expectReturnIndex
     */
    public function testGetResult($sortArr, $searchValue, $expectReturnIndex)
    {
        $this->assertEquals($expectReturnIndex, BinarySearch::getResult($sortArr, $searchValue));
    }
}
