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
 * Class FHD_Loader
 *
 * Description...
 */
class FHD_Loader extends CI_Loader {
	
	/**
	 * Replace the default $this->load->view() method
	 * with our own, so we can use Smarty!
	 *
	 * This method works identically to CI's default method,
	 * in that you should pass parameters to it in the same way.
	 *
	 * @access	public
	 * @param	string	The template path name.
	 * @param	array	An array of data to convert to variables.
	 * @param	bool	Set to TRUE to return the loaded template as a string.
	 * @return	mixed	If $return is TRUE, returns string. If not, returns void.
	 */
	public function view($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();
		
		$prefixed_template = $CI->detection->prefixed_template($view);

		if ( ! empty($prefixed_template))
		{
			$view = $prefixed_template;
		}
		
		return $CI->load->_ci_load(array('_ci_view' => $view, '_ci_vars' => $CI->load->_ci_object_to_array($vars), '_ci_return' => $return));
	}
}

/* End of file FHD_Loader.php */
/* Location: ./application/core/FHD_Loader.php */