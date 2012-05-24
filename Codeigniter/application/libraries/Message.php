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
 * Message Library
 *
 * Description...
 */
class Message {
	
	private $messages = array();
	
	private $CI;
	
	/**
	 * Constructs the messages object.
	 */
	function __construct()
	{
		$this->CI =& get_instance();
		// Add current messages to the data 
		$this->CI->data->add('messages', $this->_load());
	}
	
	/**
	 * Stores a message in the message queue.
	 * A message consists of a required message text and
	 * an optional status indicator. Valid indicators are:
	 * - success
	 * - info
	 * - warning
	 * - error
	 *
	 * A message set by this function is shown after the next page
	 * reload. Because of that it can be used to give user feedback
	 * after validating a form or storing something or just to say
	 * "Hello" after login. :)
	 *
	 * @access public
	 * @param string $message
	 * @param string $info
	 * @return void
	 */
	function set($message, $state = 'info')
	{
		// Allowed $states
		$states = array('success', 'info', 'warning', 'error');
		// We don't want to set empty messages
		if ($message !== '' && in_array($state, $states))
		{
			// We simply can add our message to our messages stack
			$this->messages[$state][] = array(
				'message' => $message,
				'state' => $state,
			);
			// At last we override all messages in the flashdata
			$this->CI->session->set_flashdata('messages', $this->messages);
		}
	}
	
	/**
	 * Builds the messages, using message views
	 *
	 * @see application/views/message/single.php
	 * @see application/views/message/multiple.php
	 *
	 * @access private
	 * @return string
	 */
	private function _load()
	{
		// Load all messages from flashdata
		$states = $this->CI->session->flashdata('messages');
		// Initialize the output storage
		$output = '';
		// Find out which view to use
		if ($states && ! empty($states))
		{
			// Iterate each message at the current status
			foreach ($states as $state => $messages)
			{	
				// Single message
				if (count($messages) == 1)
				{
					//$this->krumo->dump(get_defined_vars());
					$data = array(
						'message' => $messages[0]['message'],
						'state' => $state,
					);
					// @see application/views/message/single.php
					$output .= $this->CI->load->view('message/single', $data, TRUE);
				}
				// Multiple messages
				else
				{
					$data = array(
						'messages' => $messages,
						'state' => $state,
					);
					// @see application/views/message/multiple.php
					$output .= $this->CI->load->view('message/multiple', $data, TRUE);
				}
			}
		}
		// Return HTML output for one or more messages, otherwise return an empty string
		return $output;
	}
	
}
	
/* End of file Message.php */
/* Location: ./application/libraries/Message.php */