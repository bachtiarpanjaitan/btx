<?php
namespace Btx\Query\Statics;

/**
 * Description of Operator Constant
 *
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 * @since 15 April 2023
 */
class Operator {
    static $OPERATOR = [
        'is' => [
            'q' => 'where'
        ],
        'contain' => [
            's' => 'ILIKE',
            'q' => 'where',
            'a' => '%'
        ],
        'gte' => [
            's' => '>=',
            'q' => 'where'
        ],
        'lte' => [
            's' => '<=',
            'q' => 'where'
        ],
        'gt' => [
            's' => '>',
            'q' => 'where'
        ],
        'lt' => [
            's' => '<',
            'q' => 'where'
        ],
        'ne' => [
            's' => '<>',
            'q' => 'where'
        ],
        'between' => [
            'q' => 'whereBetween'
        ],
        'null' => [
            'q' => 'whereNull'
        ],
        'notnull' => [
            'q' => 'whereNotNull'
        ],
        'in' => [
            'q' => 'whereIn'
        ],
        'notin' => [
            'q' => 'whereNotIn'
        ]
        
    ];
}
