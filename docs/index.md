---
title: Batax Developer
layout: default
---

<p align="center"><a href="https://bataxdev.com/projects/btx-btx" target="_blank"><img src="https://bataxdev.basapadi.com/assets/images/btx-packagist.png" width="400" alt="Btx Packagist Logo"></a></p>

<p align="center">
    <a href="https://packagist.org/packages/btx/btx?"><img src="https://img.shields.io/packagist/dt/btx/btx?style=flat-square" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/btx/btx"><img src="https://img.shields.io/packagist/v/btx/btx?style=flat-square" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/btx/btx"><img src="https://img.shields.io/packagist/l/btx/btx?style=flat-square" alt="License"></a>
    <a href="https://packagist.org/packages/btx/btx"><img src="https://img.shields.io/librariesio/github/bachtiarpanjaitan/btx?style=flat-square" alt="Dependencies"></a>
    <a href="https://github.com/bachtiarpanjaitan/btx"><img src="https://img.shields.io/github/last-commit/bachtiarpanjaitan/btx/main?style=flat-square" alt="Last Commit"></a>
</p>

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

