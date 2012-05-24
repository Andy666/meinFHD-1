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
 * Detection Class
 *
 * Description...
 */
class Detection {
	
	private $prefix = 'desktop';
	
	/**
	 *
	 */
	function __construct()
	{	
		$CI =& get_instance();
		
		if ($CI->agent->is_mobile())
		{
			$this->prefix = 'mobile';
		}
	}
	
	public function prefixed_template($file)
	{	
		return $this->prefix . '/' . $file;
	}
	
	public function prefixed_method($file)
	{	
		return $this->prefix . '_' . $file;
	}

}

/* End of file Detection.php */
/* Location: ./application/libraries/Detection.php */