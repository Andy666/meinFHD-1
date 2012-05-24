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
 * Data Library
 *
 * Description...
 */
class Data {
	
	/**
	 * All data for the templates gets stored here
	 *
	 * @var array
	 */
	private $data = array();
	
	private $CI;
	
	/**
	 *
	 */
	function __construct()
	{	
		$this->CI =& get_instance();
		
		$this->init();
	}
	
	/**
	 * Adds value(s) to the main data storage.
	 * In templates the provided keys are available as variables.
	 *
	 * @access public
	 * @param string $key
	 * @param any $value
	 * @return void
	 */
	function add($key, $value = '')
	{
		// $key has to be a string in order to be used as an array key
		// $value is an empty string by default. We allow empty strings
		// because the data stored here gets used by the template engine.
		// If there's a wildcard e.g.for messages but we have no messages,
		// we should be able to pass an empty string that will be rendered.
		if (is_string($key))
		{
			// Transform FALSE and NULL to an empty string
			if ($value === FALSE OR $value === NULL)
			{
				$value = '';
			}
			// Passed data is valid -> store to data
			$this->data[$key] = $value;
		}
	}
	
	/**
	 * Loads all data that is stored.
	 * Should be used when passing data to templates.
	 *
	 * @access public
	 * @return array
	 */
	function load()
	{
		return $this->data;
	}
	
	function init()
	{	
		$url = array(
			'site' => site_url(),
			'base' => base_url(),
			'current' => current_url(),
		);
		
		$this->add('url', $url);
	}
}
	
/* End of file Data.php */
/* Location: ./application/libraries/Data.php */