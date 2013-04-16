<?php if ( !defined('MVCious')) exit('No direct script access allowed');

$config['default_controller']		= 'sample1';
$config['server_host']				= 'localhost';
$config['index_file']				= 'index.php';
$config['document_root']			= $_SERVER['DOCUMENT_ROOT']; // 'C:/wamp/www/'
$config['index_path']				= str_replace($config['index_file'], '', $_SERVER['SCRIPT_NAME']); // '/mvc/'

$config['folders'] = array(
				'controllersFolder'	=> 'controllers/',
				'modelsFolder'		=> 'models/',
				'viewsFolder'		=> 'views/',
				'librariesFolder'	=> 'libraries/',
				'helpersFolder'		=> 'helpers/'
			);

$config['database'] = array(
				'dbhost'			=> 'localhost',
				'dbname'			=> 'database',
				'dbuser'			=> 'root',
				'dbpass'			=> '123456'
			);

?>