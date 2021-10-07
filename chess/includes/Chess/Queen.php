<?php
namespace Chess;

class Queen extends AbstractChessmen {
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

        if(($this->x == $x && $this->y == $y) || ($this->x == $x && $this->y != $y) xor ($this->x != $x && $this->y == $y)){
            return true;
        }

        $subX = ($this->x >= $x ? false: true);
        $subY = ($this->y >= $y ? false: true);

        for($iX = $this->x, 
            $iY = $this->y; 
            $iX <= self::WIDTH && $iX > 0 && $iY <= self::HEIGHT && $iY > 0; 
            ($subX ? $iX++: $iX--), ($subY ? $iY++: $iY--)){
            echo "<br>x = {$iX} y = {$iY}";
            if(($iY == $y && $iX == $x) || (($this->y == $y && $iX == $x) xor ($this->x == $x && $iY == $y))){
                return true;
            }
        }

        throw new \Exception("Указаны не допустимые координаты 3");

    }



}
