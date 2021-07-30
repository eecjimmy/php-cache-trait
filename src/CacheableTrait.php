<?php


namespace eecjimmy\Basic;


/**
 * 用于缓存类的属性的特性
 * @package eecjimmy
 */
trait CacheableTrait
{
    /**
     * 实例属性的缓存值
     *
     * @var array
     */
    private $_values = [];

    /**
     * 获取实例的缓存值的方法
     *
     * @param $key
     * @param callable $cb
     * @return mixed
     */
    protected function cacheGet($key, callable $cb)
    {
        if (isset($this->_values[$key]) || array_key_exists($key, $this->_values)) {
            return $this->_values[$key];
        }

        $this->_values[$key] = $cb();
        return $this->_values[$key];
    }

    /**
     * 静态属性缓存值
     *
     * @var array
     */
    private static $_staticValues = [];

    /**
     * Get static cache value by key
     *
     * @param $key
     * @param callable $cb
     * @return mixed
     */
    protected static function cacheGetStatic($key, callable $cb)
    {
        if (isset(self::$_staticValues[$key]) || array_key_exists($key, self::$_staticValues)) {
            return self::$_staticValues[$key];
        }
        self::$_staticValues[$key] = $cb();
        return self::$_staticValues[$key];
    }
}