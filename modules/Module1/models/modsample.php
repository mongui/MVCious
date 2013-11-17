<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Modsample extends ModelBase
{
	/**
	 * This is a Model.
	 * 
	 * A model represents the underlying, logical structure of data in a
	 * software application and the high-level class associated with it.
	 * This object model does not contain any information about the
	 * user interface.
	 */
	public function modmethod()
	{
		return 'I\'m inside the Modsample model!<br />';
	}
}
?>