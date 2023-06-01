<?php

namespace Btx\Query\Transformers\Quasar;

use League\Fractal\TransformerAbstract;
class ColumnTransformer extends TransformerAbstract {

    public function transform($resp) {
        $align = 'left';
        $type = 'text';
        $show = true;
        if(isset($resp['align'])) $align = $resp['align'];
        if(isset($resp['type'])) $type = $resp['type'];
        if(isset($resp['show'])) $show = $resp['show'];
        return [
            'name' => $resp['value'],
            'required' => true,
            'label' => ucwords(implode(' ',explode('_',ucfirst($resp['label'])))),
            'align' =>  $align,
            'field' => $resp['value'],
            'sortable' => true,
            'type' => $type,
            'options' => isset($resp['options']) ? $resp['options'] : [],
            'show' => $show
        ];
    }
}