<?php
spl_autoload_register(function($className){
    require_once __DIR__ . "/includes/" . $className . ".php";
});


use Chess\King;
use Chess\Queen;

$king = new King(4, 3);
$king->move(2, 2);
print_r($king->getPosition());

$queen = new Queen(1, 1);
$queen->move(7, 3);
print_r($queen->getPosition());
