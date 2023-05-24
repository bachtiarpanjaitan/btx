#### A Common Fiture Package for Laravel Framework

#### Instalation
**Manual Instalation**
Download repo and extract into your {root project}/packages folder.
```
├── app
├── config
├── index.js
├── database
├── resources
└── packages
    ├── btx
```
Add this line autoload.psr-4 in your composer.json

```
"autoload": {
    "psr-4": {
        ...
        "Btx\\Query\\":"packages/btx/btx/query/src/",
        "Btx\\Common\\":"packages/btx/btx/common/src/",
        "Btx\\Http\\":"packages/btx/btx/http/src/",
        "Btx\\File\\":"packages/btx/btx/file/src/"
    },
    "files": [
        ...
    ]
}

```
Register Service Provider into List of Service Provider.

_lumen_
```
$app->register(Btx\Query\BtxQueryFilterServiceProvider::class);
$app->register(Btx\Common\BtxCommonServiceProvider::class);
$app->register(Btx\File\BtxCommonServiceProvider::class);
$app->register(Btx\File\BtxHttpServiceProvider::class);
```
_laravel_ config/app.php
```
'providers' => ServiceProvider::defaultProviders()->merge([
    // Other Service Providers
 
    Btx\Query\BtxQueryFilterServiceProvider::class,
    Btx\Common\BtxCommonServiceProvider::class,
    Btx\File\BtxCommonServiceProvider::class,
    Btx\File\BtxHttpServiceProvider::class
])->toArray(),
```
then, dump autoload using command <code>composer dump-autoload</code>

