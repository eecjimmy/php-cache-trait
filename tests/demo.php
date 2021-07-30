<?php

use eecjimmy\Basic\CacheableTrait;

require __DIR__ . '/../src/CacheableTrait.php';


class Demo
{

    use CacheableTrait;

    public function getUser()
    {
        return $this->cacheGet(__METHOD__, function () {
            echo "cache missing...\n";
            return 'user';
        });
    }

    public static function getStudent()
    {
        return self::cacheGetStatic(__METHOD__, function () {
            echo "cache missing...\n";
            return 'student';
        });
    }

    public function getWithArgument($a)
    {
        $key = md5(__METHOD__ . json_encode(func_get_args()));
        return $this->cacheGet($key, function () {
            echo "cache missing...\n";
            return 'with-argument';
        });
    }
}
$demo = new Demo();
$demo->getUser(); // cache missing
$demo->getUser(); // cache hits

Demo::getStudent(); // cache missing
Demo::getStudent(); // cache hits

$demo->getWithArgument('a'); // cache missing
$demo->getWithArgument('a'); // cache hits

$demo->getWithArgument('b'); // cache missing
$demo->getWithArgument('b'); // cache hits
