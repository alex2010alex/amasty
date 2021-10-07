<?php
namespace Chess;

class King extends AbstractChessmen {
    public function __construct($x = 4, $y = 3){
        parent::__construct($x, $y);

        $this->move($x, $y);
    }

    public function move($x, $y){
        $this->check($x, $y);

        $this->x = $x;
        $this->y = $y;
    }

    public function check($x, $y){
        parent::check($x, $y);

        $x = abs($x - $this->x);
        $y = abs($y - $this->y);

        if($x > self::STEP || $y > self::STEP){
            throw new \Exception("Указаны не допустимые координаты 2");
        }

        return true;
    }
}
