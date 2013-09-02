<?php namespace Opb\LaravelTxtlocal;

use Illuminate\View\Environment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class LaravelTxtlocal {

	protected $msg = array();

	public function __construct(){}

	public function incoming()
	{
		$this->msg['sender'] = Input::get('sender');
		$this->msg['keyword'] = Input::get('keyword');
		$this->msg['content'] = Input::get('content');
		$this->msg['comments'] = Input::get('comments');
		$this->msg['inNumber'] = Input::get('inNumber');
<<<<<<< HEAD
=======
		$this->msg['custom1'] = Input::get('custom1');
		$this->msg['custom2'] = Input::get('custom2');
		$this->msg['custom3'] = Input::get('custom3');
		$this->msg['firstname'] = Input::get('firstname');
		$this->msg['lastname'] = Input::get('lastname');
		$this->msg['email'] = Input::get('email');
>>>>>>> master

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
<<<<<<< HEAD
=======
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
>>>>>>> master

}