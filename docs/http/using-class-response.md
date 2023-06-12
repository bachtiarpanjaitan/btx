---
layout: default
---
### Using Class Response
#### Available Methods
| method | Description |
|--|--|
| ok(text,data,appendData) | status code 200 |
| badRequest(text,direction) | status code 400 |
| movedPermanently(text,direction) | status code 301 |
| unauthorized() | status code 401 |
| notFound(text,direction) | status code 404 |
| notAllowed(text,direction) | status code 405 |
| internalServerError(text,data) | status code 500 |

#### Example

```
use Btx\Http\Response;

class BlogService {

    /** function to get blogs */
    ...
        $results = Blog::all();
        if(!empty($result) Response::ok('Loaded',$results)
    ...
}

```