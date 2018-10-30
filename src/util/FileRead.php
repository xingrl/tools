<?php
namespace util;

class FileRead
{
    public static function getData()
    {
        $file = __FILE__;

        foreach (new \SplFileObject($file) as $line) {
            echo $line, PHP_EOL;
        }
    }
}