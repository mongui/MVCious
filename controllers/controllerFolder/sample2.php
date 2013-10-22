<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Sample2 extends ControllerBase
{
	/**
	 * This is a Controller.
	 * 
	 * A controller is the link between a user and the system. It provides
	 * the user with input by arranging for relevant views to present
	 * themselves in appropriate places on the screen. It provides means
	 * for user output by presenting the user with menus or other means of
	 * giving commands and data. The controller receives such user output,
	 * translates it into the appropriate messages and pass these messages
	 * on to one or more of the views. 
	 * 
	 * Access through:
	 * + 'http://www.example.com/controllerfolder/sample2'
	 * + 'http://www.example.com/controllerfolder/sample2/world'
	 * + 'http://www.example.com/controllerfolder/sample2/index'
	 * + 'http://www.example.com/controllerfolder/sample2/index/world'
	 */
	function index($arg = NULL)
	{
		$this->hello($arg);
	}

	/**
	 * Access through:
	 * + 'http://www.example.com/controllerfolder/sample2/hello'
	 * + 'http://www.example.com/controllerfolder/sample2/hello/world'
	 */
	function hello($arg = NULL)
	{
		echo "Hello $arg!";
	}
}
