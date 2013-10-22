<?php if ( !defined('MVCious')) exit('No direct script access allowed');

$config['default_controller']		= 'sample1';
//$config['controller_extension']	= 'html';
$config['server_host']				= 'localhost';
$config['index_file']				= 'index.php';
$config['document_root']			= $_SERVER['DOCUMENT_ROOT']; // '/var/www/' 'C:/wamp/www/'
$config['index_path']				= str_replace($config['index_file'], '', $_SERVER['SCRIPT_NAME']); // '/mvc/'

$config['folders'] = array(
				'controllersFolder'	=> 'controllers/',
				'modelsFolder'		=> 'models/',
				'viewsFolder'		=> 'views/',
				'librariesFolder'	=> 'libraries/',
				'helpersFolder'		=> 'helpers/'
			);

$config['database'] = array(
				'type'				=> 'mysql', // mysql, sqlite, mssql, sybase, pgsql, odbc, firebird, oracle, dblib.
				'dbhost'			=> 'localhost',
				//'filename'		=> 'database.sqlite',
				'dbname'			=> 'database',
				'dbuser'			=> 'root',
				'dbpass'			=> '123456'
			);

$config['debug']					= FALSE;
