<?php
namespace Btx\File\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

/**
 * Description of UploadTrait
 * @author bachtiarpanjaitan <bahtiarpanjaitan0@gmail.com>
 * @since 
 */
trait Upload {
     /**
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @param $req Illuminate\Http\Request;
     * @param $options array 
     * options available:
     *  - file: string - Attribute image request, default: image
     *  - size: array - final size [x,y] default: [300,300]
     *  - path: string - Destination path
     *  - permission: string - set permission folder of destination path, default: 777,
     *  - rules: string - Laravel validation format
     * @return array Image Attributes
     */
    public function uploadImage(Request $req,array $options){
        $imageProp = [];
        $_imageValidationRules = isset($options['rules'])? $options['rules']:'image|mimes:jpg,png,jpeg,svg|max:1024';
        $_avatarSize = isset($options['size'])? $options['size']:[300,300];
        $path = $options['path'];
        $permission = isset($options['permission'])? $options['permission']: '777';
        $imageAttr = isset($options['file'])?$options['file']: 'image';
        $_avatarPath = public_path($path);
        if($req->hasFile($imageAttr)){
            $image = $req->file($imageAttr);
            $imageProp['filename'] = time().'_'.$image->getClientOriginalName();
            $imageProp['extension'] = $image->getClientOriginalExtension();

            //Write Folders if not exists
            if (!file_exists($_avatarPath)) {
                mkdir($_avatarPath, $permission, true);
            }

            $manager = new ImageManager(['driver' => 'gd']);
            $objImage = $manager->make($image->path());
            $objImage->resize($_avatarSize[0],null,function ($constraint) {
                $constraint->aspectRatio();
            })->save($_avatarPath.'/'. $imageProp['filename']);

            $imageProp['path'] = url($path).'/'.$imageProp['filename'];
            return  $imageProp;

        } else return [];
    }

    /**
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @param $req Illuminate\Http\Request;
     * @param $options array 
     * options available:
     *  - file: string - Attribute image request, default: image
     *  - path: string - Destination path
     *  - permission: string - set permission folder of destination path, default: 777,
     * @return array Image Attributes
     */
    public function uploadFile(Request $request, array $options){
        $fileProp = [];
        $path = $options['path'];
        $permission = isset($options['permission'])? $options['permission']: '777';
        $fileAttr = isset($options['file'])?$options['file']: 'file';
        $_filePath = public_path($path);
        if($request->hasFile($fileAttr)){
            $file = $request->file($fileAttr);
            $fileProp['filename'] = time().'_'.$file->getClientOriginalName();
            $fileProp['extension'] = $file->getClientOriginalExtension();
            if (!file_exists($_filePath)) {
                // mkdir($_filePath, $permission, true);
            }
            $request->file($fileAttr)->move($_filePath, $fileProp['filename']);
            $fileProp['path'] = url($path).'/'.$fileProp['filename'];
            return  $fileProp;
        } else return [];
    }
}