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
 * Class FHD_Controller
 *
 * Description...
 */
class FHD_Controller extends CI_Controller
{
	/**
	 * Override the method that gets called
	 *
	 * @access public
	 * @param String $method
	 * @param Array $args
	 * @return void
	 */
    public function _remap($method, $args)
    {
    	// get the prefixed method name based in the current device
    	$prefixed_method = $this->detection->prefixed_method($method);	

		// check if the prefixed method exists
        if (method_exists($this, $prefixed_method))
        {
        	call_user_func_array(array($this, $prefixed_method), $args);
        }
        // we have no specialized method, so we should try to load
        // the fallbacl method without the prefix
        elseif (method_exists($this, $method))
        {
        	call_user_func_array(array($this, $method), $args);
        }
        // none of the methods exists, so we have a 404 error
        else {
        	show_404('page');
        }
    }
}

/* End of file FHD_Controller.php */
/* Location: ./application/core/FHD_Controller.php */