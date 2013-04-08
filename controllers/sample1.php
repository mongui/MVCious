<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Sample1 extends ControllerBase
{
	// Access through 'localhost/'. Can be changed in config.php/default_controller.
	// Access through 'localhost/sample1'.
	// Access through 'localhost/sample1/index'.
	public function index()
	{
		$this->load->model('mymodel');
		$returned1 = $this->mymodel->mymethod();
		var_dump($returned1);

		echo '<hr />';

		$this->config->set('name', 'John Smith');
		$returned2 = $this->config->get('name');
		var_dump($returned2);

		echo '<hr />';

		$data['itemlist'] = array(
								array('id_item'=>'id1', 'item'=>'item1'),
								array('id_item'=>'id2', 'item'=>'item2'),
								array('id_item'=>'id3', 'item'=>'item3'),
								array('id_item'=>'id4', 'item'=>'item4')
							);
		$this->load->view('list', $data);

		echo '<hr />';

		$this->load->helper('myhelper');
		echo 'Local time:' . sql_timestamp_to_user_defined (date('Y-m-d H:m:i'));
	}

	// Access through 'localhost/sample1/hello'.
	// Access through 'localhost/sample1/hello/world'.
	function hello( $arg = NULL )
	{
		echo "Hello $arg!";
	}
}
?>