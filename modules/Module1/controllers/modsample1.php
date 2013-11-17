<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Modsample1 extends ControllerBase
{
	/**
	 * This is a Module Controller.
	 * 
	 * Like the normal controllers, this one can be accessed through:
	 * + 'http://www.example.com/module1/modsample1'
	 * + 'http://www.example.com/module1/modsample1/index'
	 */
	public function index()
	{
		echo 'This is the first module.<br />';

		$this->load->model('modsample');
		echo $this->modsample->modmethod();

		$uri = array('module2','modsample2');
		$this->load->controller($uri);

		echo '<hr />';

		//$uri = array('module2','modsample2','hello');
		$uri = 'module2/modsample2/hello';
		$args = array('world');
		$this->load->controller($uri, $args);
	}

	/**
	 * Access through:
	 * + 'http://www.example.com/module1/modsample1/hello'
	 * + 'http://www.example.com/module1/modsample1/hello/world'
	 */
	function hello($arg = NULL)
	{
		echo "Hello $arg!";
	}
}
