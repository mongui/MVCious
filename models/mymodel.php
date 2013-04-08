<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Mymodel extends ModelBase
{
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