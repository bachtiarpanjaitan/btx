---
layout: default
---
## Directory Management
The fastest way to manage and view your directory. Directory class was support with some Laravel Collection methods.
#### Laravel Collection methods available in Directory
- [first](https://laravel.com/docs/7.x/collections#method-first)
- [last](https://laravel.com/docs/7.x/collections#method-last)
- [count](https://laravel.com/docs/7.x/collections#method-count)
- [toArray](https://laravel.com/docs/7.x/collections#method-toarray)
- [where](https://laravel.com/docs/7.x/collections#method-where)
- [whereIn](https://laravel.com/docs/7.x/collections#method-wherein)
- [whereNotIn](https://laravel.com/docs/7.x/collections#method-wherenotin)
- [sortBy](https://laravel.com/docs/7.x/collections#method-sortby)
- [sortByDesc](https://laravel.com/docs/7.x/collections#method-sortbydesc)
- [groupBy](https://laravel.com/docs/7.x/collections#method-groupby)

#### Available Attributes Directory
- withNavigation (default <code>false</code>) to show/hide navigation folder

#### Available methods in Directory
- <code>get()</code> : to retrieve list of file/folder on given path
- <code>setBasePath()</code> : set path in Directory object
- <code>createFolder()</code> : to create new folder in given path

#### Result Attribute
Result attribute must be array like:

```
[
    "id": "increment index file/folder",
    "name": "file/folder name",
    "permission": "file/folder permission",
    "path": "navigation path",
    "extension": "file extension, .(dot) if it's folder",
    "size": "size in string format",
    "byte": "size in byte",
    "created_at": "file/folder created timestamps",
    "updated_at": "file/folder updated timestamps"
]

```

#### Example
If you want to retrieve all file/folder in public directory.Import Directory Class in your working file with:

<code>use Btx\File\Directory;</code>

You can set default folder for scanning, available in **btx.php** in config folder your project with key <code>base_file_path</code>. If file doesn't exist, you can try to publish config using artisan command <code>php artisan vendor:publish</code> and select index one of Btx Provider or type <code>0</code> to publish all listed packages.

```
$dir = new Directory();
$dir->withNavigation = true; //if you want to show navigation folder
$files = $dir->scan('/public')->get();

// if default path has set into /public
$files = $dir->scan()->get();

```

If you want to use Laravel Collection
```
$dir = new Directory();
$dir->withNavigation = false; //if you don't want to show navigation folder

// get files in public where extension is pdf
$files = $dir->scan('/public')->where('extension','pdf')->get();

// get first file from public folder where extension is pdf
$files = $dir->scan('/public')->where('extension','pdf')->first();

// count all file/folder in public folder
$files = $dir->scan('/public')->count();

// if you want count folder only
$files = $dir->scan('/public')->where('extension','.')->count();

```