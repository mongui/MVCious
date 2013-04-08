<?php if ( !defined('MVCious')) exit('No direct script access allowed');

$default_controller	= 'sample1';
$server_host		= 'localhost';
$index_file			= 'index.php';
$document_root		= $_SERVER['DOCUMENT_ROOT']; // 'C:/wamp/www/'
$index_path			= str_replace($index_file, '', $_SERVER['SCRIPT_NAME']); // '/mvc/'

$folders = array(
				'controllersFolder'	=> 'controllers/',
				'modelsFolder'		=> 'models/',
				'viewsFolder'		=> 'views/',
				'librariesFolder'	=> 'libraries/',
				'helpersFolder'		=> 'helpers/'
			);

$database = array(
				'dbhost'			=> 'localhost',
				'dbname'			=> 'database',
				'dbuser'			=> 'root',
				'dbpass'			=> '123456'
			);

?>