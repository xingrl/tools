<?php
namespace util\xhprof;

class XhprofRuntimeCli
{
    private static $tags = [];

    public static function start($tag)
    {
        if (!array_key_exists($tag, self::$tags)) {
            if (extension_loaded('xhprof')) {
                echo sprintf('[%s]xhprof:collect...', date('Y-m-d H:i:s')), PHP_EOL;

                if (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION > 4) {
                    xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS);
                } else {
                    xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
                }

                self::$tags[ $tag ] = [
                    'time' => microtime(true),
                ];
            }
        }
    }

    public static function stop($tag)
    {
        if (array_key_exists($tag, self::$tags)) {
            if (extension_loaded('xhprof')) {
                $profile = [];
                if ($r = xhprof_disable()) {
                    $profile = self::replaceSlashes($r);
                }

                $data = [
                    'profile' => $profile,
                ];

                # uri
                $uri = array_key_exists('REQUEST_URI', $_SERVER)? $_SERVER[ 'REQUEST_URI' ]: null;
                if (empty($uri) && isset($_SERVER[ 'argv' ])) {
                    $cmd = basename($_SERVER[ 'argv' ][ 0 ]);
                    $uri = $cmd.' '.implode(' ', array_slice($_SERVER[ 'argv' ], 1));
                }

                # time
                $time = self::$tags[$tag]['time'];
                $time2 = explode('.', strval($time));
                $data[ 'meta' ] = [
                    'url' => trim($uri),
                    'SERVER' => self::replaceSlashes($_SERVER),
                    'get' => self::replaceSlashes($_GET),
                    'env' => self::replaceSlashes($_POST),
                    'simple_url' => trim($uri),
                    'request_ts' => [
                        'sec' => intval($time),
                        'usec' => 0
                    ],
                    'request_ts_micro' => [
                        'sec' => intval($time),
                        'usec' => intval(end($time2)),
                    ],
                    'request_date' => date('Y-m-d', $time),
                ];

                $msg = json_encode($data, JSON_UNESCAPED_UNICODE);
                $len = strlen($msg);

                if ($len < 65023) {
                    //消息大小小于datagram最大值通过udp 发送日志
                    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
                    socket_sendto($sock, $msg, $len, 0, '10.9.193.137', 9501);
                    socket_close($sock);
                } else {
                    $context = stream_context_create([
                        'http' => [
                            'method' => 'POST',
                            'timeout' => 1,
                            'header' => 'Content-Type: text/json',
                            'content' => $msg,
                        ],
                    ]);
                    if (false === ($response = file_get_contents('http://10.9.193.137/api/receiver', false, $context))) {
                        //send to php error log.
                        error_log('xhprof send data faild.');
                    }
                }
            }

            unset(self::$tags[$tag]);
            echo sprintf('[%s]xhprof:stop...', date('Y-m-d H:i:s')), PHP_EOL;
        }
    }

    /**
     * replace slashes, the key contains slashed is invalid to store mongodb
     *
     * @param $arr
     *
     * @return array
     */
    private static function replaceSlashes($arr)
    {
        $output = [];
        foreach ($arr as $k => $v) {
            $output[ strtr($k, [ '.' => '_' ]) ] = $v;
        }

        return $output;
    }
}
