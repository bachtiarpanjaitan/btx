<?php

namespace Btx\Query;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Btx\Query\Traits\QueryFilter;

class Model extends BaseModel
{   
    use QueryFilter;

    /**
     * @param $query Query
     * @param $withLimit Filter Data from limit
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $withLimit = true){
        return $this->filter($query,$withLimit);
    }
}