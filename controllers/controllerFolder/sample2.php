<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Sample2 extends ControllerBase
{
	// Access through 'localhost/controllerfolder/sample2/hello/world'.
	function hello( $arg = NULL )
	{
		echo "Hello $arg!";
	}
}
?>