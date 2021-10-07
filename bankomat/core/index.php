<?php
spl_autoload_register(function($className){
    require_once __DIR__ . "/includes/" . $className . ".php";
});

use Bankomat\Calculate;
use Bankomat\Config;

if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"])){
    switch(htmlspecialchars($_REQUEST["action"])){
        case 'calculate':
            if(isset($_REQUEST["sum"]) && !empty($_REQUEST["sum"])){
                $calc = new Calculate(htmlspecialchars($_REQUEST["sum"]));
                echo $calc->getOutput();
            }
            else {
                echo Calculate::empty();
            }
        break;
        case 'nominals':
            echo Config::getNominals(true);
        break;
    }
}
