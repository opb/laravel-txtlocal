<?php namespace Opb\LaravelTxtlocal;

use Illuminate\View\Environment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class LaravelTxtlocal {

	protected $msg = array();

	public function __construct(){}

	public function send($to_numbers, $message, $from = null){
		// load config into variables
		$test = Config::get('laravel-txtlocal::test');
		$json = Config::get('laravel-txtlocal::json');
		$info = Config::get('laravel-txtlocal::info');
		$user = Config::get('laravel-txtlocal::user');
		$hash = Config::get('laravel-txtlocal::hash');

		if(is_null($from)) $from = Config::get('laravel-txtlocal::from');

		if($test != 0) $test = 1;
		if($json != 1) $json = 0;
		if($info != 1 || $json == 1) $info = 0;

		$message = urlencode($message);

		$number_string = '';
		if(is_array($to_numbers))
		{
			for($i = 0; $i < count($to_numbers); $i++)
			{
				if($i > 0) $number_string .= ',';
				if(is_numeric($num)) $number_string .= $num;
			}
		}
		else
		{
			if(is_numeric($to_numbers)) $number_string = $to_numbers;
		}

		$data = "uname=".$user.
				"&hash=".$hash.
				"&message=".$message.
				"&from=". $from.
				"&selectednums=".$to_numbers.
				"&info=".$info.
				"&json=".$json.
				"&test=".$test;

		// Send the POST request with cURL
		$ch = curl_init('https://www.txtlocal.com/sendsmspost.php'); // note https for SSL
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // this is the result from Textlocal
		curl_close($ch);

		

	}

	public function incoming()
	{
		$this->msg['sender'] = Input::get('sender');
		$this->msg['keyword'] = Input::get('keyword');
		$this->msg['content'] = Input::get('content');
		$this->msg['comments'] = Input::get('comments');
		$this->msg['inNumber'] = Input::get('inNumber');
		$this->msg['custom1'] = Input::get('custom1');
		$this->msg['custom2'] = Input::get('custom2');
		$this->msg['custom3'] = Input::get('custom3');
		$this->msg['firstname'] = Input::get('firstname');
		$this->msg['lastname'] = Input::get('lastname');
		$this->msg['email'] = Input::get('email');

		return $this;
	}

	public function validate($conditions)
	{
		foreach($conditions as $key=>$val)
		{
			if(strtoupper($this->msg[$key]) != strtoupper($val))
			{
				return false;
			} 
		}
		return $this;
	}

	public function sender()
	{
		return trim($this->msg['sender']);
	}
	public function keyword()
	{
		return trim($this->msg['keyword']);
	}
	public function content()
	{
		return trim($this->msg['content']);
	}
	public function comments()
	{
		return trim($this->msg['comments']);
	}
	public function inNumber()
	{
		return trim($this->msg['inNumber']);
	}
	public function custom1()
	{
		return trim($this->msg['custom1']);
	}
	public function custom2()
	{
		return trim($this->msg['custom2']);
	}
	public function custom3()
	{
		return trim($this->msg['custom3']);
	}
	public function firstname()
	{
		return trim($this->msg['firstname']);
	}
	public function lastname()
	{
		return trim($this->msg['lastname']);
	}
	public function email()
	{
		return trim($this->msg['email']);
	}

}
