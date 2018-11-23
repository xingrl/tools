<?php
/**
 * Created by PhpStorm.
 * User: xingwenge
 * Date: 2018/11/6
 * Time: 11:54
 */

namespace tests\util\elasticsearch;

use util\elasticsearch\CURD;
use PHPUnit\Framework\TestCase;

class IndexADocumentTest extends TestCase
{

    public function testCreate()
    {
        CURD::create();
    }

    public function testRead()
    {
        CURD::read();
    }
}
