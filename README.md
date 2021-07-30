## usage

- `composer require eecjimmy/basic`

```php
namespace demo;
use eecjimmy\Basic\CacheableTrait;
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
```