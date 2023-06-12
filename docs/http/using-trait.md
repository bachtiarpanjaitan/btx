---
layout: default
---
### Using Trait
#### StaticResponse
StaticResponse.php use for generalization response code, actually extend function from [Http\Libraries\ApiResponse](https://github.com/bachtiarpanjaitan/btx/blob/main/btx/http/src/Libraries/ApiResponse.php)

> Available methods
- _fakeResponse(status = 200, message, data)_
    - To make response 200 (OK)
    - **@param** *status* code
    - **@param** *message* message response
    - **@param** *data* data response
    - **@return** array
- _response200(message, data)_
    - To make fake response for testing
    - **@param** *message* message response
    - **@param** *data* data response
    - **@return** array
- _response301(appendText, appendTextdir)_
    - To make response 301 (move permanently)
    - **@param** *appendText* append text direction to response
    - **@param** *appendTextDir* text
    - **@return** array
- _response400(appendText, appendTextdir)_
    - To make response 400 (bad request)
    - **@param** *appendText* append text direction to response
    - **@param** *appendTextDir* text
    - **@return** array
- _response401()_
    - To make response 401 (error Unauthorized)
    - **@param** array
- _response404(appendText, appendTextdir)_
    - To make response 404 (error not found)
    - **@param** *appendText* append text direction to response
    - **@param** *appendTextDir* text
    - **@return** array
- _response405(appendText, appendTextdir)_
    - To make response 405 (method not allowed)
    - **@param** *appendText* append text direction to response
    - **@param** *appendTextDir* text
    - **@return** array
- _response500(appendText, data)_
    - To make response 404 (server error)
    - **@param** *appendText*append text to response
    - **@return** array

#### Example

```
use Btx\Http\Traits\StaticResponse;

class BlogService {
    use StaticResponse;

    /** function to get data blog by id */
    ...
        $result = Blog::findOrFail($req->id);
        if(empty($result) $this->response400('Sorry, data request not found')
    ...
}

```