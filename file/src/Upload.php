<?php

namespace Btx\File;
use Btx\File\Traits\Upload as Up;

/**
 * Upload image and file from request
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class Upload {
    use Up;

     /**
     * Upload Image from request
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @param array $options 
     * options available:
     *  - file: string - Attribute image request, default: image
     *  - size: array - final size [x,y] default: [300,300]
     *  - path: string - Destination path
     *  - permission: string - (optional) Set permission folder of destination path, default: 777,
     *  - rules: string - (optional) Laravel validation format
     * @return array Image Attributes
     */
    public static function image($options):array{
        $request = request();
        return self::uploadImage($request,$options);
    }

    /**
     * Upload File from request
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @param array $options 
     * options available:
     *  - file: string - Attribute file request, default: file
     *  - path: string - Destination path
     *  - permission: string - (optional) Set permission folder of destination path, default: 777,
     * @return array File Attributes
     */
    public static function file($options):array{
        $request = request();
        return self::uploadFile($request,$options);
    }
}