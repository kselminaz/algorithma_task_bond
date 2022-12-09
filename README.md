<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Api larin istifadesi

Api response larin verilme qaydasi [status,data,message] seklinde olacaq



## Bond Order Api istifadesi

Api a muraciet POST metodu ile,/api/bond/{id}/order linki ile aparilir.
Api response lar asagidaki hallardan biri ola biler.
1.Eger bu id ile bond bazada yoxdursa,404 status code qayidacaq.
2.2 parametr teleb olunur,order_date ve order_count,bu parametrler uchun order_date teleb olunan(required) ve date formatda olmasi,order_count teleb olunan(required) ve eded olmasi ve min 1 deyerini almasidir,eger bu teleb olunan validasiya xetalarindan biri bash vererse 400 status code qayidacaq ve error message lar verilecek.
3.Order_date bond un emissiya tarixi(issue_date) ve son tedavul tarixi(last_circulation_date) arasinda deyilse 400 status code qayidacaq ve error message verilecek.
4.Eger butun parametrler dogru daxil edilibse order save edilecek ve BondOrder modeli 200 status code la verilecek.