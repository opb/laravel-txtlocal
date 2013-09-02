<?php namespace Opb\LaravelTxtlocal;

use Illuminate\View\Environment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class LaravelTxtlocal {

	protected $msg = array();

	public function __construct()
	{
		Log::info('Constructed Txtlocal');
	}

	public function incoming()
	{
		Log::info('Run incoming()');
		$this->msg['sender'] = Input::get('sender');
		$this->msg['keyword'] = Input::get('keyword');
		$this->msg['content'] = Input::get('content');
		$this->msg['comments'] = Input::get('comments');
		$this->msg['inNumber'] = Input::get('inNumber');
		Log::info(serialize($this));

		return $this;
	}

	public function validate($conditions)
	{
		foreach($conditions as $key=>$val)
		{
			if(strtoupper($this->msg[$key]) != strtoupper($val))
			{
				Log::info('Validation failed');
				return false;
			} 
		}
		Log::info('Validation succeeded');
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

}