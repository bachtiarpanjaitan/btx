<?php
namespace Btx\Query\Traits;

use Illuminate\Database\Eloquent\Builder as eloBuilder;
use Btx\Query\Statics\Operator;

/**
 * Description of Query Filter Trait
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 * @since 
 */
trait QueryFilter {
    
    private $_defaultLimit;
    private $_config;
    private $_request;

    public function setDefaultLimit(int $limit) {
        $this->_defaultLimit = $limit;
    }

    /**
     * filter record of model using parameter request
     * @param Illuminate\Database\Eloquent\Builder $model
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter( &$model, $withLimit = true){
        $this->_init();
        $page = 1;
        $limit = $this->_request['_limit'];
        foreach($this->_request as $key => $value){
            $relation = explode('__', $key);
            $table = [];
            if(count($relation) >= 2) {
                $key = $relation[count($relation) -1];
                unset($relation[count($relation)-1]);
                $table = $relation;
            }

            $_filter = explode("_",$key);
            if (count($_filter)<=1) continue;
            $_filter_name = $_filter[count($_filter)-1];
            unset($_filter[count($_filter)-1]);
            $column = implode("_",$_filter);
            // dd($_filter_name);
            $operators= Operator::$OPERATOR;
            if(isset($operators[$_filter_name])){
                $params = [
                    'table' => $table,
                    'column' => $column,
                    'value' => $value,
                    'operator' => $operators[$_filter_name],
                    'filter' => $_filter_name
                ];
                $this->_generateQuery($model, $params);
            }

            if($key == '_page') $page = $value;
            if($key == '_limit') $limit = $value;

            if ($page > 1)  $skip = ($page - 1) * $limit;
            else  $skip = 0;

            if($key == '_sort'){
                $sort = explode(':',$value);
                if(count($sort) < 2) continue;
                if(!empty($sort[0]) && !empty($sort[1])) $model->orderBy(trim($sort[0]),trim($sort[1]));
            }
        }
        if($withLimit) $model->skip($skip)->take($limit);
       return $model;
    }

    /**
     * Genereate Query, supports up to 3 deep tree relationships
     * 
     * @param $model Illuminate\Database\Eloquent\Builder $model
     * @param $params array
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function _generateQuery(&$model, $params){
        $tables = $params['table'];
        $column = $params['column'];
        $value = $params['value'];
        $op = $params['operator'];
        $filter = $params['filter'];
        if(count($tables) > 0) {
            foreach ($tables as $table) {
                $this->_calculateRelation($model,$table,[
                    'column' => $column,
                    'value' => $value,
                    'op' => $op,
                    'filter' => $filter
                ]);
            }
        } else $this->_generator($model,$column,$value,$op,$filter);
    }

    private function _calculateRelation(&$query,$table, $attr){
        if(isset($table)){
            $query->whereHas($table, function($query) use ($attr) {
                $this->_generator($query,$attr['column'],$attr['value'],$attr['op'],$attr['filter']);
            });
        } else  $this->_generator($query,$attr['column'],$attr['value'],$attr['op'],$attr['filter']);
    }

    /**
     * Generate query
     */
    private function _generator(&$query,$column,$value,$op,$filter){
        if(in_array($filter,['in','notin','between'])){
            $_values = explode(',',$value);
            if(count($_values) == 2) $query->{$op['q']}($column, $_values);
        }
        elseif(in_array($filter,['null','notnull'])){
            $query->{$op['q']}($column);
        }
        elseif(empty($value) && $value != 0) 
            $query->{$op['q']}($column);
        elseif(isset($op['a']) && isset($op['s']) && isset($op['q']))
            $query->{$op['q']}($column,$op['s'],$op['a'].$value.$op['a']);
        elseif (isset($op['s']) && isset($op['q']))
            $query->{$op['q']}($column,$op['s'],$value);
        elseif (!isset($op['s']) && isset($op['q'])) $query->{$op['q']}($column,$value);
    }

    private function _init(){
        $this->_config = config('btx');
        $request = request()->all();
        if(isset($request['_limit'])){
            $max = (int) $this->_config['max_query_limit'];
            if((int) $request['_limit'] > $max) $request['_limit'] = (int) $max;
        } else $request['_limit'] = 10;

        $this->_request = $request;
        if(empty($this->_config)) throw 'Config file not found';
    }
}