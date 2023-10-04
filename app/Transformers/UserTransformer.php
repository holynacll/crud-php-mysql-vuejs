<?php

namespace App\Transformers;

class UserTransformer
{
    public static function toArray($object) :array
    {
        return self::dismount($object);
    }

    public static function dismount($object) 
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }


}