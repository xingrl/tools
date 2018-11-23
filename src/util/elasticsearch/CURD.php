<?php
namespace util\elasticsearch;

use Elasticsearch\ClientBuilder;

class CURD
{
    public static function create()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abcdd']
        ];

        $client = ClientBuilder::create()->build();
        $response = $client->index($params);
        print_r($response);
    }

    public static function read()
    {
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id'
        ];

        $client = ClientBuilder::create()->build();
        $response = $client->get($params);
        print_r($response);
    }
}