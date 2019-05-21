# laravelasterisk
A simple call using Asterisk for Laravel
  - Simple and extensible
  - Method chaining
  - Formatter (alpha)

laravelasterisk is a Laravel package which allows you to make calls. The package is in **development stage** for time being, and not ready for production uses.

----

### Version
1.0

### Requirements

* Laravel - version 5 (version 4 <= untested, need help here). 
* PHP - version => 7.1

----

### Installation

Download the package as a zip, and then put it on /vendor folder. 

Add the following line on your **composer.json** file, under the psr-4:

```
composer require mihaicebotari001/laravelasterisk
```


```
"psr-4": {
    ...
    "mihaicebotari001\\laravelasterisk\\": "vendor/mihaicebotari001/laravelasterisk/src"
}
```

After that, register the LaravelAsteriskServiceProvider in the /config/app.php file, under the **providers** array:
```php
'mihaicebotari001\LaravelAsterisk\Laravel\LaravelAsteriskServiceProvider'
```

And in the same file, put the LaravelAsterisk alias under the **aliases** array:
```php
'LaravelAsterisk' => 'mihaicebotari001\LaravelAsterisk\Facades\LaravelAsterisk'
```

And finally, run all the migration files
```sh
php artisan migrate --path=vendor/mihaicebotari001/laravelasterisk/src/database/migrations
```

----

## Usage

First, you must supply with the user_id (which you can get from your favourite authentication managers). This will make sure projects and tasks belongs to the right user.                           |

----

### Todo

 - Formatter (50%)

----
