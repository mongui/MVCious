<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Mymodel extends ModelBase
{
	/**
	 * This is a Model.
	 * 
	 * A model represents the underlying, logical structure of data in a
	 * software application and the high-level class associated with it.
	 * This object model does not contain any information about the
	 * user interface.
	 */
	public function mymethod()
	{
		$sql = 'SELECT username, email FROM users LIMIT 3';

		$dbcall1 = $this->db->query($sql);
		$rtrn[] = $dbcall1->fetchObject();

		$mydbconn = $this->database($this->dbdata, true);
		$dbcall2 = $mydbconn->prepare($sql);
		$dbcall2->execute();
		$rtrn[] = $dbcall2->fetchAll();

		return $rtrn;
	}
}
?>