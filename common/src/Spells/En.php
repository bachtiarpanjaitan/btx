<?php
namespace Btx\Common\Spells;

class En {
    private $_ones = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen'
    );

    private $_tens = array(
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety'
    );

    private $_thousands = array(
        '',
        'thousand',
        'million',
        'billion',
        'trillion',
        'quadrillion',
        'quintillion',
        'sextillion',
        'septillion',
        'octillion',
        'nonillion',
        'decillion',
        'undecillion',
        'duodecillion',
        'tredecillion',
        'quattuordecillion',
        'quindecillion',
        'sexdecillion',
        'septendecillion',
        'octodecillion',
        'novemdecillion',
        'vigintillion'
    );


	public function generate($number) {
        if ($number < 20) {
            return $this->_ones[$number];
        }
    
        if ($number < 100) {
            $unit = $number % 10;
            $ten = $number - $unit;
            return $this->_tens[$ten] . ' ' . $this->_ones[$unit];
        }
    
        $currentUnit = 0;
        $result = '';
    
        while ($number > 0) {
            $currentNumber = $number % 1000;
            $number = (int)($number / 1000);
    
            if ($currentNumber > 0) {
                $currentResult = '';
                if ($currentNumber >= 100) {
                    $hundred = (int)($currentNumber / 100);
                    $currentResult .= $this->_ones[$hundred] . ' hundred ';
                    $currentNumber %= 100;
                }
    
                if ($currentNumber >= 20) {
                    $tensDigit = (int)($currentNumber / 10);
                    $currentResult .= $this->_tens[$tensDigit] . ' ';
                    $currentNumber %= 10;
                }
    
                if ($currentNumber > 0) {
                    $currentResult .= $this->_ones[$currentNumber] . ' ';
                }
    
                $currentResult .= $this->_thousands[$currentUnit];
    
                if (!empty($result)) {
                    $result = $currentResult . ' ' . $result;
                } else {
                    $result = $currentResult;
                }
            }
    
            $currentUnit++;
        }
    
        return $result;
    }
}