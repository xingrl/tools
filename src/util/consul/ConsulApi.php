<?php
namespace util\consul;

use SensioLabs\Consul\ServiceFactory;

class ConsulApi
{
    public static function kv()
    {
        $options = [
            'base_uri' => 'http://172.17.0.4:8500',
        ];
        $sf = new ServiceFactory($options);

        $kv = $sf->get('kv');
        $r2 = $kv->put('test/foo/bar', 'bazinga');
        $r3 = $kv->get('test/foo/bar', ['raw' => true]);
        $r4 = $kv->delete('test/foo/bar');

        var_dump($kv, $r2, $r3, $r4);
    }

}