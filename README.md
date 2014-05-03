#Laravel 4 Txtlocal package

##Version 1.0 update - May 2014

As of May 2014, this package has been upgraded, as Txtlocal have altered the way their API works. Major amendments:

* Making use of Guzzle 4 as opposed to cURL directly
* Removed functionality to process received text messages, as this is super simple to do in Laravel anyway, and this function brought nothing to the party.
* Better in-line documentation.

Having said all that, Txtlocal do provide their own PHP library, though it's not on composer. I may look into producing a straight PHP version (as opposed to Laravel-specific) which makes more use of the functionality that Txtlocal expose through their API. Currently we're only doing send SMS and getting the account balance.

Any queries, please get in touch.

To do:

 * Add some tests for Travis


###About
TxtLocal is a UK based service providing incoming and outgoing SMS services. This library aims to provide access to some of these functions within the Laravel PHP framework, as well as serving as package development practice for myself!

Currently provides the following functions:

1. HTTP POST endpoint for incoming TxtLocal messagebox. (Txtlocal service which allows an SMS to be received by them and the details POSTed to a URL specified by you)
2. Send SMS function through TxtLocal API using cURL
3. Check the balance of SMS/MMS credits left on the account


###Installation

Installation via composer...

Add `opb/laravel-txtlocal` to your composer requirements:

```php
"require": {
    "opb/laravel-txtlocal": "~1"
}
```

Now run `composer update`

Once the package is installed, open your `app/config/app.php` configuration file and locate the `providers` key.  Add the following line to the end:

```php
'Opb\LaravelTxtlocal\LaravelTxtlocalServiceProvider',
```

Next, locate the `aliases` key and add the following line:

```php
'LaravelTxtlocal' => 'Opb\LaravelTxtlocal\Facades\LaravelTxtlocal',
```

Finally, publish the default configuration (it will end up in `app/config/packages/opb/laravel-txtlocal/config.php`):

```bash
$ php artisan config:publish opb/laravel-txtlocal
```

###Usage

1. Send an SMS to one or more numbers. See the package config file to set up API access.

    ```php
    // test route to demo SMS sending
    Route::get('send', function()
    {
        $result = LaravelTxtlocal::send(array('447712345678'), 'This is a test message', 'SenderName');
        return $result;
    }
    ```
2. Check your balance of SMS and/or MMS credits

    ```php
    // test route to get the account balance
    Route::get('checkbalance', function()
    {
        $result = LaravelTxtlocal::balance();
        return $result;
    }
    ```