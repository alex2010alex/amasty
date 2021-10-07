<?php
namespace Bankomat;

class Config {
    private static $nominals = array(
        5,
        10,
        20,
        50,
        100,
        500
    );

    public static function getNominals($json = false){
        if($json){
            return json_encode(self::$nominals);
        }
        return self::$nominals;
    }
}