<?php
namespace Chess;

interface IChessmen {
    public function move($x, $y);
    public function check($x, $y);
    public function getPosition();
}
