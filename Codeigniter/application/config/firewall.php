<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Define the login page to which the user will be redirected
| -------------------------------------------------------------------
*/

$firewall['login_page'] = 'app/login';

/*
| -------------------------------------------------------------------
|  Firewall config initialization
| -------------------------------------------------------------------
*/

$firewall['access_control'] = array();

/*
| -------------------------------------------------------------------
|  Firewall routes
| -------------------------------------------------------------------
|  
|  Routes to be protected by the Firewall.
|  
|  Prototype:
|
|    $access_control = array(
|        'some_name' => array(
|            'pattern' => '/^regex$/',
|            'roles' => array('guest', 'user', '...'),
|        ),
|    )
|
*/

$firewall['access_control'] = array(
	'login' => array(
		'pattern' => '^/app',
		'roles' => array('user'),
	),
	'stundenplan' => array(
		'pattern' => '^/stundenplan',
		'roles' => array('user'),
	),
	'stundenplan/mach' => array(
		'pattern' => '^/stundenplan/f2',
		'roles' => array('dozent'),
	),
);

/*
| -------------------------------------------------------------------
|  Add firewall configuration to global config
| -------------------------------------------------------------------
*/

$config['firewall'] = $firewall;