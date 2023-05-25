<?php
namespace Btx\Http\Traits;

use Btx\Http\Libraries\ApiResponse;

/**
 * Description of Static Response
 * @author bachtiarpanjaitan <bahtiarpanjaitan0@gmail.com>
 * @since 
 */
trait StaticResponse {
    
    /**
     * memberikan sebuah respon palsu guna hanya untuk testing response
     * @return array
     */
    public function fakeResponse($status = true, $message = 'Fake Response', $data = null) {
        return ApiResponse::make($status, $message, $data);
    }
    
    /**
     * memberikan status default 301 (Moved Permanently)
     * @return array
     */
    public function response301(string $appendText = '', string $appendTextDir = '') {
        ApiResponse::setStatusCode(301);
        ApiResponse::setAppendMessage($appendText);
        if (!empty($appendTextDir)) {
            ApiResponse::setAppendMessageDir($appendTextDir);
        }
        return ApiResponse::make(false, '', null);
    }

    public function response200(string $appendText = '',$data = null, $appendData = null){
        if(!empty($appendData)) ApiResponse::setIncludeData($appendData);
        return ApiResponse::make(true, $appendText, $data);
    }
    
    /**
     * memberikan status default 400 (Bad request)
     * @return array
     */
    public function response400(string $appendText = '', string $appendTextDir = '') {
        ApiResponse::setStatusCode(400, false);
        ApiResponse::setAppendMessage($appendText);
        if (!empty($appendTextDir)) {
            ApiResponse::setAppendMessageDir($appendTextDir);
        }
        return ApiResponse::make(false, '', null);
    }
    
    /**
     * memberikan status default 401 (error Unauthorized)
     * @return array
     */
    public function response401() {
        ApiResponse::setStatusCode(401);
        return ApiResponse::make(false, '', null);
    }
    
    /**
     * memberikan status default 404 (error not found)
     * @return array
     */
    public function response404(string $appendText = '', string $appendTextDir = '') {
        ApiResponse::setStatusCode(404);
        ApiResponse::setAppendMessage($appendText);
        if (!empty($appendTextDir)) {
            ApiResponse::setAppendMessageDir($appendTextDir);
        }
        return ApiResponse::make(false, '', null);
    }
    
    /**
     * memberikan status default 500 (error disisi server)
     * @return array
     */
    public function response500(string $appendText = '', $data = []) {
        ApiResponse::setStatusCode(500);
        ApiResponse::setAppendMessage($appendText);
        ApiResponse::setIncludeData($data);
        return ApiResponse::make(false, '', null);
    }
    
    
}
