<?php

class Stundenplan extends FHD_Controller {
	
	public function index()
	{
		//$this->data->add('eigener_key', 'super_value');
		$this->load->view('stundenplan', $this->data->load());
	}
	
	public function f1()
	{
		print 'Funktion 1!';
	}
	
	public function f2()
	{
		print 'Funktion 2!';
	}
	
	public function f3()
	{
		print 'Funktion 3!';
	}
	
	public function mobile_f3()
	{
		print 'Mobile Funktion 3!';
	}
	
}