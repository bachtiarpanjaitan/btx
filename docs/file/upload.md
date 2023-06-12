---
layout: default
---
## Upload
Save image or file from Request parameter
#### Available Options Image Upload
| Option | Description | Default | Required |
|--|--|--|--|
| file | Attribute image request | image | y |
| size | final size [width,height] | [300,300] | y |
| path | Destination path | - | y |
| permission | Destination path | - | n |
| rules | Laravel validation format | - | n |

#### Available Options File Upload
| Option | Description | Default | Required |
|--|--|--|--|
| file | Attribute image request | file | y |
| path | Destination path | - | y |
| permission | Destination path | - | n |

#### Example

Assume that a user sends image data with param **image** and file with param **file**

```
use Btx\File\Upload;
use Btx\Http\Response;

class UserController {

    /** function to upload file */
    ...
       $path = Upload::file([
            'file' => 'file',
            'path' => 'uploads/'
        ]);

        Response::ok('Uploaded',$path)
    ...

    /** function to upload image */
    ...
       $path = Upload::image([
            'file' => 'file',
            'size' => [500,500],
            'path' => 'uploads/'
        ]);

        Response::ok('Uploaded',$path)
    ...
}


```

Return format must be array like:

```
[
    "filename": "file name",
    "path": "url of image/file",
    "extension": "file extension"
]

```