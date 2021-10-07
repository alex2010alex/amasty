<?php
namespace Strup;
class WordGame {
    private $colorsOnWords = array(
        array("name" => "red", "code" => "#ff0000"),
        array("name" => "blue", "code" => "#0000ff"),
        array("name" => "green", "code" => "#008000"),
        array("name" => "yellow", "code" => "#ffff00"),
        array("name" => "lime", "code" => "#00FF00"),
        array("name" => "magenta", "code" => "#ff00ff"),
        array("name" => "black", "code" => "#000000"),
        array("name" => "gold", "code" => "#ffd700"),
        array("name" => "gray", "code" => "#808080"),
        array("name" => "tomato", "code" => "#ff6347")
    );

    private $countColors;

    private $resultArray = array();

    public function __construct($width, $height){
        $this->width = $width;
        $this->height = $height;
        $this->countColors = count($this->colorsOnWords) - 1;

        $this->genMatrix();
    }

    private function genMatrix(){
        $resArray = array();

        for($i = 0; $i < $this->height; $i++){
            $bufferName = array();
            $bufferCode = array();
            for($o = 0; $o < $this->width; $o++){
                do {
                    $name = random_int(0, $this->countColors);
                }
                while(isset($bufferName[$name]));

                do {
                    $code = random_int(0, $this->countColors);
                }
                while(isset($bufferCode[$code]) && $this->colorsOnWords[$name]['code'] == $this->colorsOnWords[$code]['code']);
                

                $resArray[$i][$this->colorsOnWords[$name]['name']] = $this->colorsOnWords[$code]['code'];
                $bufferName[$name] = true;
                $bufferCode[$code] = true;
            }
        }

        $this->resultArray = $resArray;
    }

    public function getMatrix(){
        return $this->resultArray;
    }

    public function getWidth(){
        return $this->width;
    }

    public function getHeight(){
        return $this->height;
    }
}
