<?php
namespace Btx\File\Traits;

trait Directory {

    private function cfo($path,$permission){
        if (!file_exists($path)) {
            mkdir($path, $permission, true);
        }
    }

    private function cfob($intance, array $paths,$permission){
        $results = [];
        foreach ($paths as $key => $path) {
            $newPath = cleanPath($intance->_basePath.'/'.$path);
            $result = $this->cfo($newPath,$permission);
            array_push($results,$result);
        }

        return $results;
    }
}