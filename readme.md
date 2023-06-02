## BTX

[![Total Downloads](https://img.shields.io/packagist/dt/btx/btx?style=for-the-badge)](https://packagist.org/packages/btx/btx?)
[![Latest Stable Version](https://img.shields.io/packagist/v/btx/btx?style=for-the-badge)](https://packagist.org/packages/btx/btx)
[![License](https://img.shields.io/packagist/l/btx/btx?style=for-the-badge)](https://packagist.org/packages/btx/btx)
[![Dependencies](https://img.shields.io/librariesio/github/bachtiarpanjaitan/btx?style=for-the-badge)](https://packagist.org/packages/btx/btx)
[![Stars](https://img.shields.io/packagist/stars/btx/btx?style=for-the-badge)](https://packagist.org/packages/btx/btx)
[![Social](https://img.shields.io/github/stars/btx?style=for-the-badge)](https://github.com/bachtiarpanjaitan/btx)
[![Social](https://img.shields.io/github/last-commit/bachtiarpanjaitan/btx/main?style=for-the-badge)](https://github.com/bachtiarpanjaitan/btx)


#### Requirements
* PHP Version : 7.4+
* PHP Modules : GD

#### Tested On
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
$app->register(Btx\File\BtxFileServiceProvider::class);
$app->register(Btx\Http\BtxHttpServiceProvider::class);
```
_laravel_ config/app.php
```
'providers' => [
    // Other Service Providers
 
    Btx\Query\BtxQueryFilterServiceProvider::class,
    Btx\Common\BtxCommonServiceProvider::class,
    Btx\File\BtxFileServiceProvider::class,
    Btx\Http\BtxHttpServiceProvider::class
],
```
then, dump autoload using command <code>composer dump-autoload</code>.

See detail documentations on [Wiki](https://github.com/bachtiarpanjaitan/btx/wiki)

