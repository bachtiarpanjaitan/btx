<?php
namespace Btx\Query;
use Spatie\Fractalistic\ArraySerializer;
use Btx\Query\Transformers\Quasar\ColumnTransformer;

/**
 * Transform data into spesific framework
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class Transformer {


    /**
     * Generate column for Quasar Framework 
     * @source https://quasar.dev/
     * @param array $columns array of columns
     * with format:
     * [
     *    ['value' => '', 'label' => '', 'align' => ''],
     *    ....
     * ]
     * 
     */
    public static function quasarColumn($columns){
        return fractal($columns, new ColumnTransformer(), ArraySerializer::class);
    }
}