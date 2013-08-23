<?php if ( !defined('MVCious')) exit('No direct script access allowed');

class Languages
{
	private $main_lang;
	private $base_lang;
	private $lang_folder;
	private $lang_lines = array();
	private $loaded_files = array();

	function __construct()
	{
		$inst =& get_instance();
		$this->set_folder();
	}

	function __get($key)
	{
		$inst =& get_instance();
		return $inst->$key;
	}

	private function set_folder()
	{
		$folders = $this->config->get('folders');

		if ( !array_key_exists('languagesFolder', $folders) )
		{
			$folders['languagesFolder'] = 'languages/';
			$this->config->set('folders', $folders);
		}

		$this->lang_folder = $folders['languagesFolder'];
	}

	public function set_lang( $lang = NULL )
	{
		$this->main_lang = $lang;
		$this->loaded_files[$lang] = array();
		$this->lang_lines[$lang] = array();
		return TRUE;
	}

	public function set_base_lang( $lang = NULL )
	{
		$this->base_lang = $lang;
		$this->loaded_files[$lang] = array();
		$this->lang_lines[$lang] = array();
		return TRUE;
	}

	public function get_lang()
	{
		return $this->main_lang;
	}

	public function get_base_lang()
	{
		return $this->base_lang;
	}

	public function load_file( $file, $setlang = NULL )
	{
		if ( isset($setlang) && !isset($this->main_lang) )
			$this->set_lang($setlang);
		elseif ( !isset($setlang) && isset($this->main_lang) )
			$setlang = $this->main_lang;
		else
		{
			trigger_error('Main language not set.', E_USER_WARNING);
			return FALSE;
		}

		if ( isset($setlang) && !array_key_exists($setlang, $this->lang_lines) )
			$this->lang_lines[$setlang] = array();

		if ( $this->loadable_file($file . '.php') )
		{
			if ( !isset($this->lang_lines[$this->main_lang]) )
				$this->lang_lines[$this->main_lang] = array();

			require_once($this->lang_folder . $this->main_lang . '/' . $file . '.php');

			$this->loaded_files[$setlang][] = $file . '.php';

			$this->lang_lines[$this->main_lang] = array_merge($this->lang_lines[$this->main_lang], $lang);
			return TRUE;
		}

		return FALSE;
	}

	public function line( $ln = NULL )
	{
		if ( !isset($ln) )
			return FALSE;
		if ( array_key_exists($ln, $this->lang_lines[$this->main_lang]) )
			return $this->lang_lines[$this->main_lang][$ln];
		elseif ( isset($this->base_lang) )
		{
			$this->load_base();
			if ( isset($this->lang_lines[$this->base_lang][$ln]) )
				return $this->lang_lines[$this->base_lang][$ln];
			else
				return FALSE;
		}
		else
		{
			trigger_error('Language line "' . $ln . '" does not exist.', E_USER_WARNING);
			return FALSE;
		}
	}

	public function lines()
	{
		if ( !isset($this->lang_lines[$this->main_lang]) )
			return FALSE;

		if ( isset($this->base_lang) )
		{
			$this->load_base();
			return array_merge($this->lang_lines[$this->base_lang], $this->lang_lines[$this->main_lang]);
		}
		else
			return $this->lang_lines[$this->main_lang];
	}

	private function loadable_file( $filename = NULL, $lang = NULL )
	{
		if ( !isset($lang) )
			$lang = $this->main_lang;

		if ( in_array($filename, $this->loaded_files[$lang]) )
			return FALSE;

		if ( !is_dir($this->lang_folder) )
		{
			trigger_error('"' . $this->lang_folder . '" folder does not exist.', E_USER_WARNING);
			return FALSE;
		}

		if ( !is_dir($this->lang_folder . $lang) )
		{
			trigger_error('Language "' . $lang . '" not found in "' . $this->lang_folder . '" folder.', E_USER_WARNING);
			return FALSE;
		}

		if ( !file_exists($this->lang_folder . $lang . '/' . $filename) )
		{
			trigger_error('Language file "' . $filename . '" not found in "' . $this->lang_folder . '" folder.', E_USER_WARNING);
			return FALSE;
		}

		return TRUE;
	}

	private function load_base()
	{
		$files = array_diff($this->loaded_files[$this->main_lang], $this->loaded_files[$this->base_lang]);

		if ( isset($files) )
		{
			foreach ( $files as $file )
			{
				if ( $this->loadable_file($file, $this->base_lang) )
				{
					require_once($this->lang_folder . $this->base_lang . '/' . $file);
					$this->loaded_files[$this->base_lang][] = $file;
					$this->lang_lines[$this->base_lang] = array_merge($this->lang_lines[$this->base_lang], $lang);
				}
			}
			return TRUE;
		}
		else
			return FALSE;
	}
}
?>
