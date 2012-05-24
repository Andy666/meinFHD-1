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
 * Class App
 *
 * Description...
 */
class App extends FHD_Controller {
	
	/**
	 * Index
	 *
	 * .../app
	 * .../app/index
	 */
	public function index()
	{
		$this->load->view('app', $this->data->load());
	}
	
	/**
	 * Login
	 *
	 * .../app/login
	 * .../login
	 */
	public function login()
	{
		// read the post parameters
		$name = $this->input->post('name');
		$pass = $this->input->post('pass');
		
		// if we have a value
		if ($name || $pass)
		{
			// call the login funtion from the authentication class
			if ($this->authentication->login($name, $pass))
			{
				// user is logged in -> set message and redirect to frontpage
				$this->message->set(sprintf('Eingeloggt! (ID: %s)', $this->authentication->user_id()));
				redirect('/');
			}
			else
			{
				// something got wrong -> set message and redirect to login page
				$this->message->set('User oder Passwort falsch!', 'error');
				redirect('app/login');
			}
		}
		
		// if there's no post data, we should show the login screen
		$this->load->view('login', $this->data->load());
	}
	
	/**
	 * Logout
	 *
	 * .../app/logout
	 * .../logout
	 */
	public function logout()
	{
		$this->message->set(sprintf('Ausgeloggt! (ID: %s)', $this->authentication->user_id()));
		$this->authentication->logout();
		redirect('app/login');
	}
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */