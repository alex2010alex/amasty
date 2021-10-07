<?php
namespace Converter;

class Convert{
    private $from;
    private $to;
    private $sum;
    private $date;
    private $converted;
    private $curs;

    public static $ERROR = "Error";

    public function __construct($from, $to, $sum, $date = false){
        $this->from = $from;
        $this->to = $to;
        $this->sum = $sum;
        $this->date = $date;
        $this->converted;

        $this->calculate();
    }

    public function getConverted(){
        return json_encode(array(
            "sum" => $this->converted,
            "curs" => round($this->curs, 2),
            "to" => $this->to
        ));
    }

    private function getCource($currency){

        if(in_array($currency, Currency::getAllCurrency())){

            if($this->date){
                /*$date = implode("-", array_reverse(explode(".", $this->date)));
                $dateQ = "&ondate=" . $date;*/

                $dateQ = "&ondate=" . $this->date;
            }

            $url = "https://www.nbrb.by/api/exrates/rates/{$currency}?parammode=2".$dateQ;

            /*$curGet = curl_init(); 
            curl_setopt($curGet, CURLOPT_URL, $url); 
            curl_setopt($curGet, CURLOPT_RETURNTRANSFER, 1); 
            $data = json_decode(curl_exec($curGet)); 
            curl_close($curGet); */

            /* ИЛИ */

            $data = json_decode(file_get_contents($url));
            
            //print_r($data);

            return array(
                "curs" => $data->Cur_OfficialRate,
                "scale" => $data->Cur_Scale
            );
        }
        else {
            die(self::$ERROR);
        }
    }

    private function calculate(){
        if(in_array($this->from, Currency::getAllCurrency()) && in_array($this->to, Currency::getAllCurrency())){
            
            if($this->from == Currency::getAllCurrency()[0]){
                $toCurs = $this->getCource($this->to);
                $newSum = $this->sum / $toCurs['curs'] * $toCurs['scale'];

                $this->curs = $toCurs['curs'];
            }
            elseif($this->to == Currency::getAllCurrency()[0]){
                $formCurs = $this->getCource($this->from);
                $newSum = $this->sum * $formCurs['curs'] / $formCurs['scale'];

                $this->curs = $formCurs['curs'];
            }
            else{
                $toCurs = $this->getCource($this->to);
                $formCurs = $this->getCource($this->from);

                $newSum = $this->sum / $toCurs['curs'] * $toCurs['scale'];
                $newSum = $newSum * $formCurs['curs'] / $formCurs['scale'];

                $this->curs = $formCurs['curs'];
            }

            $this->converted = round($newSum, 2);
        }
        else {
            die(self::$ERROR);
        }
    }
}