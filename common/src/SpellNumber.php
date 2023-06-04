<?php

namespace Btx\Common;
use Btx\Common\Spells\{
    Id,
    En
};

/**
 * Spelling number into another language
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class SpellNumber {
    private static $_spells = [
        'id' => Id::class,
        'en' => En::class
    ];

    /**
     * Spelling number into another language
     * Support Language:
     * - id : Indonesian
     * - en : English
     * @param integer|double|float $number 
     * @param string $language
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     */
    public static function generate($number, $language = 'id') : String{
        $class = new self::$_spells[strtolower($language)]();
        return $class->generate((double) $number);
    }
}