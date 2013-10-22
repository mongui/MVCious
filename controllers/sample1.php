<?php if (!defined('MVCious')) exit('No direct script access allowed');

class Sample1 extends ControllerBase
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
	 * + 'http://www.example.com/sample1'
	 * + 'http://www.example.com/sample1/index'
	 * + 'http://www.example.com/'
	 *   -> Since this controller is set as the default in
	 *      config.php/default_controller.
	 */
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
					'Main language: '		. $a,
					'Secondary language: '	. $b,
					'Line "txt1": '			. $c,
					'Line "txt3": '			. $d,
					'Language lines: '		, $e
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

		$this->load->helper('time');
		echo 'Local time:' . timestamp_to_user_defined(date('Y-m-d H:m:i'));

		$this->load->model('mymodel');
		$returned1 = $this->mymodel->mymethod();
		var_dump($returned1);
	}

	/**
	 * Access through:
	 * + 'http://www.example.com/sample1/hello'
	 * + 'http://www.example.com/sample1/hello/world'
	 */
	function hello($arg = NULL)
	{
		echo "Hello $arg!";
	}
}
