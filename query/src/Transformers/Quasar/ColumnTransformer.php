<?php

namespace Btx\Query\Transformers\Quasar;

use League\Fractal\TransformerAbstract;
class ColumnTransformer extends TransformerAbstract {

    public function transform($resp) {
        $align = 'left';
        $type = 'text';
        $show = true;
        $optionFilter = false;
        if(isset($resp['align'])) $align = $resp['align'];
        if(isset($resp['type'])) $type = $resp['type'];
        if(isset($resp['show'])) $show = $resp['show'];
        if(isset($resp['option_filter'])) $optionFilter = $resp['option_filter'];
        return [
            'name' => $resp['value'],
            'required' => true,
            'label' => ucwords(implode(' ',explode('_',ucfirst($resp['label'])))),
            'align' =>  $align,
            'field' => $resp['value'],
            'sortable' => true,
            'type' => $type,
            'options' => isset($resp['options']) ? $resp['options'] : [],
            'show' => $show,
            'class' => $resp['class'] ?? '',
            'styles' => $resp['styles'] ?? '',
            'option_filter' => $optionFilter
        ];
    }
}