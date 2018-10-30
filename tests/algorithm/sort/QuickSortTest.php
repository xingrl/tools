<?php
namespace tests\algorithm\sort;

use algorithm\sort\QuickSort;
use PHPUnit\Framework\TestCase;

class QuickSortTest extends TestCase
{

    public function sortData()
    {
        return [
            ['data' => [6,3,8,6,4,2,9,5,1], 'result' => [1,2,3,4,5,6,6,8,9]],
        ];
    }

    /**
     * @dataProvider sortData
     * @param $data
     * @param $result
     */
    public function testGetResult($data, $result)
    {
        $this->assertEquals($result, QuickSort::getResult($data));
    }
}
