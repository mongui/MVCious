<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Modsample2 extends ControllerBase
{
	/**
	 * This is a Module Controller.
	 * 
	 * Like the normal controllers, this one can be accessed through:
	 * + 'http://www.example.com/module2/modsample2'
	 * + 'http://www.example.com/module2/modsample2/index'
	 */
	public function index()
	{
		echo 'This is the second module.<br />';
		
		$this->load->model('mmss2');
		echo $this->mmss2->modmethod();
	}

	/**
	 * Access through:
	 * + 'http://www.example.com/module2/modsample2/hello'
	 * + 'http://www.example.com/module2/modsample2/hello/world'
	 */
	function hello($arg = NULL)
	{
		echo "Hello $arg!";
	}
}
