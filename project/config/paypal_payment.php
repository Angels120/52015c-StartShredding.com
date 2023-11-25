<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => 'AZSSWe5UiSHPsUZafKFtRlKPFiWGFTAkIXXK_5qiZC52V_p_pGd8lEsEjjpik6S9Gnb3yfR58vGHpP2a',
		'ClientSecret' => 'EF-TxFbLcfYpWgapGo2qAk7RN0YqWBCZ65dYHXw6l0XXO762aq6b93Agk52kSDmJd0cCh-rT-SF7CF1z',
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		'LogLevel' => 'FINE',
	),
);
