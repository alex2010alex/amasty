<?php
spl_autoload_register(function($className){
    require_once __DIR__ . "/includes/" . $className . ".php";
});


use Chess\King;
use Chess\Queen;

//$king = new King(4, 3);

//print_r($king->getPosition());

//$king->move(5, 2);

//print_r($king->getPosition());

$king = new Queen(4, 3);

print_r($king->getPosition());

$king->move(8, 3);

print_r($king->getPosition());