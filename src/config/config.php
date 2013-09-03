<?php

return array(

	'test' => 0,	// 0 for live mode, 1 for test mode (only appears in control panel, not sent)
	'info' => 1,	// receive info back about the request to the URL defined in TxtLocal control panel
	'json' => 1,	// receive info back about the request as JSON instead. Overrides 'info'
	'user' => 'you@example.com',		// your login email with Txtlocal
	'hash' => 'passwordHashFromTxtlocalControlPanel',	// your password hash, form the Control Panel
	'from' => 'Sender Name',		// up to 11 chars or 14 digits. Can be overridden during send


);