<?php namespace Opb\LaravelTxtlocal;

use GuzzleHttp\Client as GuzzleClient;

class LaravelTxtlocal {

	/**
	 * Api Key
	 *
	 * @var string The API key for access to the Txtlocal account
	 *
	 */
	protected $apiKey;

	/**
	 * Default from name/number
	 *
	 * @var string Default name or number that the SMS will be sent from
	 *
	 */	
	protected $from;

	/**
	 * Set test mode to on or off
	 *
	 * @var boolean Use the test mode provided by Txtlocal - no real SMS sending
	 *
	 */	
	protected $testMode;

	/**
	 * Guzzle HTTP Client - used to access Txtlocal API
	 *
	 * @var GuzzleHttp\Client Instance of the Guzzle Client class
	 *
	 */	
	protected $guzzle;

	/**
	 * Constructor
	 *
	 * @param GuzzleHttp\Client $guzzle Instance of the Guzzle Client class
	 * @param string $apiKey The API key for access to the Txtlocal account
	 * @param string $from Default name or number that the SMS will be sent from
	 * @param boolean $testMode Use the test mode provided by Txtlocal - no real SMS sending
	 *
	 * @return void
	 *
	 */
	public function __construct(GuzzleClient $guzzle, $apiKey, $from, $testMode)
	{
		$this->apiKey = $apiKey;
		$this->from = $from;
		$this->testMode = $testMode;
		$this->guzzle = $guzzle;
	}

	/**
	 * Get the SMS and MMS balance on the account
	 *
	 * @return string JSON encoded string of the current SMS and MMS balances
	 *
	 */
	public function balance(){

		$postData = array(
			'body' => array(
				'apiKey' => $this->apiKey,
			)
		);

		$response = $this->guzzle->post('https://api.txtlocal.com/balance', $postData);

		$response = json_decode($response->getBody());
		if($response->status != 'success')
			throw new LaravelTxtlocalException('Unexpected result from Txtlocal API');
		
		return json_encode($response->balance);

	}

	/**
	 * Send an SMS to one or more numbers
	 *
	 * @param array $recipients recipient numbers (as strings) to which the message is sent
	 * @param string $message The message to be sent
	 * @param string $from if set, overrides the default sender name
	 *
	 * @return string JSON encoded string of the 
	 *
	 */
	public function send($recipients, $message, $from = null){

		if(!$from) $from = $this->from;
		if(preg_match('/^[0-9]+$/', $from) && (strlen($from) < 3 || strlen($from) > 13))
			throw new LaravelTxtlocalException('Digits-only from field should be between 3 and 13 characters');
		else if(strlen($from) < 3 || strlen($from) > 11)
			throw new ExceLaravelTxtlocalExceptiontion('Character-based from field should be between 3 and 11 characters');

		if(strlen($message) > 766)
			throw new LaravelTxtlocalException('Message should not exceed 766 characters in length');

		foreach($recipients as $num)
		{
			if(!preg_match('/^[0-9]+$/i', $num)) 
				throw new LaravelTxtlocalException('Phone number should be digits only');
		}

		$recipients = implode(',', $recipients);

		$postData = array(
			'body' => array(
				'apiKey' => $this->apiKey,
				'message' => $message,
				'numbers' => $recipients,
				'sender' => $from,
				'test' => $this->testMode
			)
		);

		$response = $this->guzzle->post('https://api.txtlocal.com/send/', $postData);
		$response = json_decode($response->getBody());

		return json_encode($response);
	}

}
