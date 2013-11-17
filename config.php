<?php if ( !defined('MVCious')) exit('No direct script access allowed');

$config['default_controller']		= 'sample1';
//$config['controller_extension']	= 'html';
$config['protocol']					= 'http';
$config['server_host']				= 'localhost';
$config['index_file']				= 'index.php';
$config['app_path']					= APP_PATH . '/'; // '/var/www/MVCious' 'C:/wamp/www/MVCious/'
$config['relative_path']			= str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\','/', $config['app_path'])); // 'MVCious/'
$config['server_root']				= $_SERVER['DOCUMENT_ROOT']; // '/var/www/' 'C:/wamp/www/'
$config['server_relative_path']		= str_replace($config['index_file'], '', $_SERVER['SCRIPT_NAME']);  // '/MVCious/'
$config['server_path']				= $config['protocol'] . '://' . $_SERVER['SERVER_NAME'] . str_replace($config['index_file'], '', $_SERVER['SCRIPT_NAME']); //  'http://localhost/MVCious/'

$config['modules']					= TRUE;

$config['folders'] = array(
				'controllersFolder'	=> 'controllers/',
				'modelsFolder'		=> 'models/',
				'viewsFolder'		=> 'views/',
				'librariesFolder'	=> 'libraries/',
				'helpersFolder'		=> 'helpers/'
			);

$config['autoload'] = array(
				'models'			=> array(),
				'libraries'			=> array(),
				'helpers'			=> array()
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
