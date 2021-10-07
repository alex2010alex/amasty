<?php
namespace Bankomat;

class Calculate {
    private $sum;
    private $status = "SUCCESS";
    private $result = array();

    public function __construct($sum){
        $this->sum = (int)$sum;
        $this->calculate();
    }

    private function calculate(){
        $razr = array();
        $preResult = array();
        $tSum = $this->sum;
        $s = strlen((string)$tSum);
        $ed = ((string)$tSum)[$s-1];

        if(!in_array($ed, Config::getNominals()) && $ed != 0){
            $this->status = "ERROR";

            if($ed >= 5){
                $maxS = $tSum + (10 - $ed);  
                $minS = $tSum - ($ed - 5);                
            }
            else {
                $maxS = $tSum - ($ed - 5);
                $minS = $tSum - $ed; 
            }
            $this->result = "Неверная сумма. Выберите {$minS} или {$maxS}.";

            return false;
        }

        for($i = 0; $i < $s; $i++){
            $nSum = intval(mb_substr((string)$tSum, 1));
            //echo $nSum;
            $tSum -= $nSum;
            if(!$tSum){
                continue;
            }
            $razr[] = $tSum;
            $tSum = $nSum;
        
        }
        
        foreach($razr as $val){
            $chstn = array();

            foreach(Config::getNominals() as $nom){
                if(is_float($ch = $val / $nom)){
                    continue;
                }
                $chstn[$nom] = $ch;
            }

            $tmpR = min($chstn);
            $preResult[] = array("nominal" => array_search($tmpR, $chstn), "count" => $tmpR);
            
        }

        foreach($preResult as $val){
            if(isset($this->result[$val["nominal"]])){
                $this->result[$val["nominal"]] += $val["count"];
            }
            else{
                $this->result[$val["nominal"]] = $val["count"];
            }
        }

        return true;
    }

    public function getOutput(){
        return json_encode(array(
            "STATUS" => $this->status,
            "RESULT" => json_encode($this->result)
        ));
    }

    public function empty(){
        return json_encode(array(
            "STATUS" => "ERROR",
            "RESULT" => "Пожалуйста введите требуемую сумму."
        ));
    }
}