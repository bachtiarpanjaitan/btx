#### A Common Fiture Package for Laravel Framework

#### Requirements
* PHP Version : 7.4+
* PHP Modules : GD

#### Tested On
* Laravel
* Lumen
#### Instalation

**Install using Composer**

Run command <code>composer require btx/btx</code>, then <code>composer dump-autoload</code>



**Install Manual**
Download repo and extract into your {root project}/packages folder.
```
├── app
├── config
├── database
├── resources
└── packages
    ├── btx
    ...
```
Add this line autoload.psr-4 in your composer.json (You can choose one or all of them)

```
"autoload": {
    "psr-4": {
        ...
        "Btx\\Query\\":"packages/btx/query/src/",
        "Btx\\Common\\":"packages/btx/common/src/",
        "Btx\\Http\\":"packages/btx/http/src/",
        "Btx\\File\\":"packages/btx/file/src/"
    },
    "files": [
        ...
    ]
}

```
Register Service Provider into List of Service Provider.

_lumen_ bootstrap/app.php
```
$app->register(Btx\Query\BtxQueryFilterServiceProvider::class);
$app->register(Btx\Common\BtxCommonServiceProvider::class);
$app->register(Btx\File\BtxCommonServiceProvider::class);
$app->register(Btx\File\BtxHttpServiceProvider::class);
```
_laravel_ config/app.php
```
'providers' => [
    // Other Service Providers
 
    Btx\Query\BtxQueryFilterServiceProvider::class,
    Btx\Common\BtxCommonServiceProvider::class,
    Btx\File\BtxCommonServiceProvider::class,
    Btx\File\BtxHttpServiceProvider::class
],
```
then, dump autoload using command <code>composer dump-autoload</code>.

See detail documentations on [Wiki](https://github.com/bachtiarpanjaitan/btx/wiki)

