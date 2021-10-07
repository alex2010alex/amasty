<?php
namespace Converter;

class Currency {
    private static $currency = array(
        "BYN",
        "RUB",
        "USD",
        "EUR",
    );

    public static function getAllCurrency($json = false){
        if($json){
            return json_encode(self::$currency);
        }
        else {
            return self::$currency;
        }
    }
}