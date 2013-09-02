#Laravel 4 Txtlocal package

<<<<<<< HEAD
=======
###About
TxtLocal is a UK based service providing incoming and outgoing SMS services. This library aims to provide access to some of these functions within the Laravel PHP framework, as well as serving as package development practice for myself!

Currently provides the following functions:

1. HTTP POST endpoint for incoming TxtLocal messagebox. (Txtlocal service which allows an SMS to be received by them and the details POSTed to a URL specified by you)


>>>>>>> master
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
'LaravelTxtlocal' => 'Opb\LaravelTxtlocal\Facades\LaravelTxtlocal',
```

Finally, publish the default configuration (it will end up in `app/config/packages/opb/laravel-txtlocal/config.php`):

```bash
$ php artisan config:publish opb/laravel-txtlocal
<<<<<<< HEAD
```
=======
```

###Usage

1. Receive an SMS sent to a Txtlocal messagebox by POST. Provides the following data fields: `custom1` `custom2` `custom3` `sender` `email` `keyword` `content` `firstname` `lastname` `inNumber` `comments`

    ```php
    // Create a route for Txtlocal to POST to
    Route::post('incoming', function()
    {
        // Process the incoming SMS details
        $msg = LaravelTxtlocal::incoming();

        // Validate by passing an array of field names and expected values
        // Returns false if validation fails
        $msg->validate(array('keyword' => 'ku', 'firstname' => 'Olly'));
        if($msg)
        {
        	// Return the content of the message. Any field can be accessed in the same way
	        return $msg->content();
	    }
        else
        {
            return 'validation failed';
        }
    });
    ```
>>>>>>> master
