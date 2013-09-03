#Laravel 4 Txtlocal package

###About
TxtLocal is a UK based service providing incoming and outgoing SMS services. This library aims to provide access to some of these functions within the Laravel PHP framework, as well as serving as package development practice for myself!

Currently provides the following functions:

1. HTTP POST endpoint for incoming TxtLocal messagebox. (Txtlocal service which allows an SMS to be received by them and the details POSTed to a URL specified by you)
2. Send SMS function through TxtLocal API using cURL
<<<<<<< HEAD
=======
3. Check the balance of SMS/MMS credits left on the account
>>>>>>> dev


###Installation

**Note: requires the php-cUrl library to be installed.**

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
2. Send an SMS to one or more numbers. See the package config.php to set up API access.

    ```php
    // test using a route to hit to activate the SMS send
    Route::post('send', function()
    {
        // parm1 is the internationalised version of the number to send to
        //     without any leading zeroes or +, or an array of these numbers
        // parm2 is the message
        // parm3 is the 'from' name/number. Optional, will use the config value
        //     if omitted. Max 11 chars if alphanumeric, or 14 numbers
<<<<<<< HEAD
=======
        // returns the result of the send from Txtlocal. See 'info' and 'json'
        //     config options
        $result = LaravelTxtlocal::send('447739123456', 'This is a test message', 'opb');
        dd($result);
    }
    ```
3. Check your balance of SMS and/or MMS credits

    ```php
    // test using a route to grab the balance
    Route::post('checkbalance', function()
    {
        // parm1 should be set to true to display MMS 
        // returns the response from Txtlocal. See 'info' and 'json' config options
>>>>>>> dev
        $result = LaravelTxtlocal::send('447739123456', 'This is a test message', 'opb');
        dd($result);
    }
    ```