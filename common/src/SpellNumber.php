<?php

namespace Btx\Common;
use Btx\Common\Spell\{
    Id
};

/**
 * Spelling number into another language
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class SpellNumber {
    private static $_spells = [
        'id' => Id::class
    ];

    /**
     * Spelling number into another language
     * Support Language:
     * - id : Indonesian
     * @param integer|double|float $number 
     * @param string $language
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     */
    public static function generate($number, $language = 'id') : String{
        $class = new self::$_spells[strtolower($language)]();
        return $class->generate((int) $number);
    }
}