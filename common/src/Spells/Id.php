<?php
namespace Btx\Common\Spells;

class Id {
    private $_bilangan = [" ", " satu", " dua", " tiga", " empat", " lima",
    " enam", " tujuh", " delapan", " sembilan", " sepuluh", " sebelas"];


	/**
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @param integer|double|float $val;
     * Convert integer,double,float into string spelling based on Indonesian
     * @return string
     */
	public function generate($val){
		return trim(self::convert($val));
	}

    private function convert($value){
        if($value < 12){
			return "". $this->_bilangan[(int)$value];
		}
		else if($value < 20){
			return $this->convert($value - 10) . " belas";
		}
		else if($value < 100){
			return ($this->convert($value / 10) . " puluh") .  $this->convert($value % 10); 
		}
		else if($value < 200 ){ 
			return " seratus" . $this->convert($value - 100);
		}
		else if($value < 1000){
			return ($this->convert($value / 100) . " ratus" ) . $this->convert($value % 100);
		}
		else if($value < 2000){
			return " seribu" . $this->convert($value - 1000);
		}
		else if($value < 1000000){
			return ($this->convert($value /1000) . " ribu") . $this->convert($value % 1000);
		}
		else if($value < 1000000000){
			return ($this->convert($value /1000000) . " juta") . $this->convert($value % 1000000);
		}
		else if($value < (double) "1000000000000L"){
			return ($this->convert($value /1000000000) . " milyar") . $this->convert($value % 1000000000);
		}
		else if($value < (double) "1000000000000000L"){
			return ($this->convert($value / (double) "1000000000000L") . " triliun") . $this->convert($value % (double) "1000000000000L");
		}
		return null;
    }
}