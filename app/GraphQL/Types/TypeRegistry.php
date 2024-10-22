<?php
namespace App\GraphQL\Types;
class TypeRegistry
{
    private static $types = [];

    public static function get(string $className)
    {
        if (!isset(self::$types[$className])) {
            self::$types[$className] = new $className();
        }
        return self::$types[$className];
    }
}