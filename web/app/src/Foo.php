<?php

/**
 * I belong to a file
 */

namespace App\Acme;
use Predis\Client;
/**
 * I belong to a class
 */
class Foo
{
    /**
     * Gets the name of the application.
     */
    public function getName()
    {
        return 'Nginx PHP MySQL!!!';
    }

    public function testRedis() 
    {
        $redisHost = getenv('REDIS_HOST') ?: '127.0.0.1';
        $redisPort = getenv('REDIS_PORT') ?: 6379;
        $redisPassword = getenv('REDIS_PASSWORD');
        $client = new Client([
            'scheme' => 'tcp',
            'host'   => $redisHost,
            'port'   => $redisPort,
            'password' => $redisPassword // 如果需要驗證
        ]);
        // 設置一個鍵
        $client->set('test-key', 'Hello, Redis!');

        // 獲取一個鍵的值
        $value = $client->get('test-key');
        return $value; // 輸出: Hello, Redis!
    }
}
