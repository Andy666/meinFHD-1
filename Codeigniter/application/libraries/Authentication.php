<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * meinFHD WebApp
 * 
 * @version 0.0.1
 * @copyright Fachhochschule Duesseldorf, 2012
 * @link http://www.fh-duesseldorf.de
 * @author Manuel Moritz (MM), <manuel.moritz@fh-duesseldorf.de>
 */

/**
 * Authentication Library
 *
 * Description...
 */
class Authentication {
	
	private $uid = 0;
	private $name = 'Guest';
	private $email = '';
	private $roles = array('guest');
	
	private $CI;
	
	/**
	 *
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
		// Store the user ID even if it does not exist
		$uid = $this->CI->session->userdata('uid');

		// If we have an ID which is not NULL, FALSE or 0,
		// a valid user ID is stored in the session which
		// means that there's a user logged in.
		if ($uid)
		{
			// Set the user ID.
			$this->uid = $uid;
			$this->roles[] = 'user';
		}
		// Invoke the firewall to see if the current user has access
		$this->_invoke_firewall();
	}
	
	/**
	 * This is the main login function.
	 *
	 * We check the database for the given username and password.
	 * If they are available and match, the user can be logged in.
	 * To do so, we save the user's data to the user object and
	 * initialize a session where we store the users's ID (uid)
	 *
	 * @access public
	 * @param string name
	 * @param string pass
	 * @return bool
	 */
	public function login($name, $pass)
	{
		// Load the user ID that matches the username and password
		$query = $this->CI->db->query('SELECT BenutzerID 
									FROM benutzer 
									WHERE LoginName = ? AND Passwort = MD5(?)', array($name, $pass));
		
		// There is a user that matches the parameters
		if ($query->num_rows() == 1)
		{
			// The uid ist stored as BenutzerID
			$this->uid = $query->row()->BenutzerID;
			//$this->_load();
			// Keep the user logged in by initializing the session
			$this->CI->session->set_userdata('uid', $this->uid);
			// User has logged in successfully
			return TRUE;
		}
		
		return FALSE;
	}
		
	/**
	 * Determines wether the user is logged in or not.
	 *
	 * @access public
	 * @return bool
	 */
	public function is_logged_in()
	{
		return (bool) $this->uid;
	}
	
	/**
	 * Checks the user's access for the requested page.
	 * 
	 * NEEDS TO BE REWRITTEN! -> NOT WORKING AS DESCRIBED
	 *
	 * For detailed permission checks a string or an array
	 * of strings can be passed along. The function will ask
	 * the database if the user has the permissions an will 
	 * either do nothing or redirect to a 403 page.
	 *
	 * @access public
	 * @param string/array
	 * @return void
	 */
	public function check_access($actions = NULL)
	{
		if ( ! $this->is_logged_in())
		{
			redirect('/');
		}
	}
	
	/**
	 * Destroys the current session so that the user is logged out.
	 *
	 * @access public
	 * @return void
	 */
	public function logout()
	{
		// IS DELETING uid SAVE ENOUGH???
		$this->CI->session->unset_userdata('uid');

		//$this->CI->session->sess_destroy();
		$this->uid = 0;
		$this->name = 'Guest';
		$this->email = '';
		$this->roles = array('guest');
	}
	
	/**
	 * Returns the user id.
	 *
	 * @access public
	 * @return int
	 */
	public function user_id()
	{
		if (is_numeric($this->uid))
		{
			return $this->uid;
		}	
		return FALSE;
	}
	
	/**
	 * The firewall detects access controled routes and determines,
	 * if the current user has access to it.
	 *
	 * @access private
	 * @return TRUE if the user has access, void on fail
	 */
	private function _invoke_firewall()
	{
		// Load firewall config
		$this->CI->config->load('firewall');

		// Load the login route
		$login_page = $this->CI->config->item('login_page', 'firewall');

		// Load the current route
		$current_route = $this->CI->uri->ruri_string();

		// If we're on the login page, always allow access
		if ($current_route == "/{$login_page}")
		{
			return TRUE;
		}
		
		// We are not on the login page, so we need to check the access.
		// Load access controled routes
		$controled_routes = $this->CI->config->item('access_control', 'firewall');

		foreach ($controled_routes as $controled_route)
		{
			$pattern = '/' . str_replace('/', '\/', $controled_route['pattern']) . '/';
			
			if (preg_match($pattern, $current_route) == 1)
			{
				// The current route matches the condition
				// Now let's look, if we have access to that role
				if ( ! $this->_user_can_access($controled_route['roles'], $this->roles))
				{
					// 403 if access denied, redirect to login page if not logged in
					if ($this->uid == 0)
					{
						redirect($login_page);
					}
					else
					{
						$this->CI->message->set('403 - Forbidden', 'error');
						redirect('app', 403);
					}
				}	
			}
		}
		return TRUE;
	}
	
	/**
	 * Walks through two arrays looking for matches.
	 * If there is a match, we know, that the user has access.
	 *
	 * @access private
	 * @param Array $allowed
	 * @param Array $given
	 * @return TRUE on match, otherwise FALSE
	 */
	private function _user_can_access($allowed, $given)
	{
		foreach ($allowed as $a)
		{
			if (in_array($a, $given))
			{
				return TRUE;
			}
		}
		return FALSE;
	}
}

/* End of file Authentication.php */
/* Location: ./application/libraries/Authentication.php */