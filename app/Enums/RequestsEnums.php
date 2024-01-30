<?php
namespace App\Enums;

enum RequestsEnums: string{

    case Active = 'На рассмотрении';
    case Resolved = 'Завершена';

    public static function get($key){
        return self::fromName($key);
    }

    public static function fromName(string $name){
        return constant("self::$name")->value;
    }

}