<?php

namespace Btx\File;

use Exception;
use Btx\File\Traits\Directory as DT;

/**
 * Folder and File Management
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class Directory {

    use DT;

    protected string $_path = '';
    protected array $_data = [];
    protected $_params = null;
    protected $_action = null;
    protected array $_grammar = [];
    protected string $_basePath = '';

    public bool $withNavigation = false;

    public function __construct()
    {
        $this->_basePath = realpath(app()->basePath(config('btx.base_file_path')));
        include __DIR__.'/../../helpers/lumen.php';
    }

    /**
     * scan file from folder
     */
    public function scan($dir = ''){
        try {
            $path = $this->_basePath.'/'.$dir;
            $this->_path = cleanPath('/'.$dir);
            $this->_basePath = cleanPath($path);
            return $this;
        } catch (Exception $e){
            return $e ;
        }
    }

    public function read($path){
        return file_get_contents(cleanPath($this->_basePath.'/'.$path));
    }

    public function get(){
        $files = scandir($this->_basePath);
        $data = collect($this->_format($files));
        if(count($this->_grammar) > 0){
            foreach ($this->_grammar as $grammar) {
                $data = $data->{$grammar['grammar']}(...$grammar['params']);
            }
            return $data;
        } else return $data;
        
    }

    public function first(){
        return $this->get()->first();
    }

    public function last(){
        return $this->get()->last();
    }

    public function count(){
        return $this->get()->count();
    }

    public function toArray(){
        return $this->get()->toArray();
    }

    public function where(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function whereIn(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function whereNotIn(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function sortBy(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function sortByDesc(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function groupBy(...$params){
        array_push($this->_grammar,[
            'params' => $params,
            'grammar' => __FUNCTION__
        ]);
        return $this;
    }

    public function setBasePath($path){
        $this->_basePath = $path;
        return $this;
    }

    public function createFolder($name, $permission = 0755){
        if(gettype($name) === 'array'){
            $this->_data = $this->cfob($this,$name,$permission);
        } elseif(gettype($name) === 'string'){
            $path = cleanPath($this->_basePath.'/'.$name);
            $this->_data = [$this->cfo($path,$permission)];
        } else return $this->_data;

        return $this;
    }

    private function _format($files){
        $results = [];
        foreach ($files as $i => $file) {
            $realpath = $this->_basePath.'/'.$file;
            if(!$this->withNavigation) if ($file === '.' || $file === '..') continue;
            $permission = fileperms($realpath);
            $formattedPermission = sprintf('%04o', $permission & 0777);
            $created = date('Y-m-d H:i:s', filectime($realpath));
            $updated = date('Y-m-d H:i:s', filemtime($realpath));
            $path = $this->_path;
            $ext = '.';
            $size = null;
            if(is_dir($realpath)) {
                $path = cleanPath($this->_path.'/'.$file);
            } else {
                 $ext = pathinfo(cleanPath($this->_path.'/'.$file))['extension'];
                 $size = formatSizeUnits(filesize($realpath));
            }

            array_push($results, collect([
                'id'            => $i,
                'name'          => $file,
                'permission'    => $formattedPermission,
                'path'          => $path,
                'extension'     => strtolower($ext),
                'size'          => $size,
                'byte'          => filesize($realpath),
                'created_at'    => $created,
                'updated_at'    => $updated
            ]));
        }
        return $results;
    }

}