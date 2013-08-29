<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Sample2 extends ControllerBase
{
	// Access through 'localhost/controllerfolder/sample2/hello/world'.
	// Access through 'localhost/controllerfolder/sample2/world'.
	function hello( $arg = NULL )
	{
		echo "Hello $arg!";
	}

	function index( $arg = NULL )
	{
		$this->hello($arg);
	}
}
?>