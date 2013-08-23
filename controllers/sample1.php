<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Sample1 extends ControllerBase
{
	// Access through 'localhost/'. Can be changed in config.php/default_controller.
	// Access through 'localhost/sample1'.
	// Access through 'localhost/sample1/index'.
	public function index()
	{
		$this->load->library('languages');
		$this->languages->set_lang('es');
		$this->languages->set_base_lang('en');
		$this->languages->load_file('langfile1');

		$a = $this->languages->get_lang();
		$b = $this->languages->get_base_lang();

		$c = $this->languages->line('txt1');
		$d = $this->languages->line('txt3');
		$e = $this->languages->lines();

		var_dump(
					'Main language: ' . $a,
					'Secondary language: ' . $b,
					'Line "txt1": ' . $c,
					'Line "txt3": ' . $d,
					'Language lines: ', $e
				);


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

		$this->load->model('mymodel');
		$returned1 = $this->mymodel->mymethod();
		var_dump($returned1);
	}

	// Access through 'localhost/sample1/hello'.
	// Access through 'localhost/sample1/hello/world'.
	function hello( $arg = NULL )
	{
		echo "Hello $arg!";
	}
}
?>