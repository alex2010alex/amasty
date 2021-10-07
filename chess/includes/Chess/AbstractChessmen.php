<?php
namespace Chess;

abstract class AbstractChessmen implements IChessmen {
    const WIDTH = 8;
    const HEIGHT = 8;
    const STEP = 1;
    protected $x;
    protected $y;


    public function __construct($x = 0, $y = 0){
        self::check($x, $y);

        $this->x = $x;
        $this->y = $y;
    }

    public function getPosition(){
        return [$this->x, $this->y];
    }

    public function check($x, $y){
        if($x > self::WIDTH || $y > self::HEIGHT){
            throw new \Exception("Указаны не допустимые координаты");
        }

        return true;
    }
}
