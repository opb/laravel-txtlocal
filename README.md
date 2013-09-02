#Laravel 4 Txtlocal package

###Installation
Add `opb/laravel-txtlocal` to your composer requirements:

```php
"require": {
    "opb/laravel-txtlocal": "*"
}
```

Now, run `composer update`

Once the package is installed, open your `app/config/app.php` configuration file and locate the `providers` key.  Add the following line to the end:

```php
'Opb\LaravelTxtlocal\LaravelTxtlocalServiceProvider',
```

Next, locate the `aliases` key and add the following line:

```php
'Txtlocal' => 'Opb\LaravelTxtlocal\Facades\Txtlocal',
```

Finally, publish the default configuration (it will end up in `app/config/packages/opb/laravel-txtlocal/config.php`):

```bash
$ php artisan config:publish opb/laravel-txtlocal
```