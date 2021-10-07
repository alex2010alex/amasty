<?php
spl_autoload_register(function($className){
    require_once __DIR__ . "/includes/" . $className . ".php";
});

use Converter\Convert;
use Converter\Currency;

if($_REQUEST["action"] == "convert" && $_REQUEST["from"] && $_REQUEST["to"] && $_REQUEST["sum"]){
    $from = htmlspecialchars($_REQUEST["from"]);
    $to = htmlspecialchars($_REQUEST["to"]);
    $sum = htmlspecialchars($_REQUEST["sum"]);
    $date = ($_REQUEST["date"] ? htmlspecialchars($_REQUEST["date"]) : false);

    if($from == $to){
        die(Convert::$ERROR);
    }

    $data = new Convert($from, $to, $sum, $date);
    echo $data->getConverted();
}
elseif($_REQUEST["action"] && $_REQUEST["action"] == "getCurr"){
    echo Currency::getAllCurrency(true);
}
else {
    die(Convert::$ERROR);
}

/*$data = new Convert("USD", "RUB", 2, "05.10.2015");
echo $data->getConverted();*/

//print_r($data->getCource("RUB"));