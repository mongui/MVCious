<?php if (!defined('MVCious')) exit('No direct script access allowed');
/**
 * Languages Class
 *
 * Loads a defined languages
 *
 * @package		MVCious
 * @subpackage	Libraries
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */
class Languages
{
	/**
	 * International code of the main language.
	 *
	 * @var		string
	 * @access	private
	 */
	private $_main_lang;

	/**
	 * International code of the base language.
	 *
	 * @var		string
	 * @access	private
	 */
	private $_base_lang;

	/**
	 * Folder where the language files are.
	 *
	 * @var		string
	 * @access	private
	 */
	private $_lang_folder;

	/**
	 * Array where are stored language lines loaded from their files.
	 *
	 * @var		array
	 * @access	private
	 */
	private $_lang_lines = array();

	/**
	 * Language filenames.
	 *
	 * @var		array
	 * @access	private
	 */
	private $_loaded_files = array();

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function __construct()
	{
		$inst =& get_instance();
		$this->_set_folder();
	}

	/**
	 * Get instance from MVCious.
	 *
	 * @access	private
	 * @param	mixed
	 * @return	array
	 */
	function __get($key)
	{
		$inst =& get_instance();
		return $inst->$key;
	}

	/**
	 * Set Folder
	 *
	 * Looks if the config file has a route to the Languages folder.
	 * If not, generates one by default.
	 *
	 * @access	private
	 * @return	void
	 */
	private function _set_folder()
	{
		$folders = $this->config->get('folders');

		if (!array_key_exists('languagesFolder', $folders)) {
			$folders['languagesFolder'] = 'languages/';
			$this->config->set('folders', $folders);
		}

		$this->_lang_folder = $folders['languagesFolder'];
	}

	/**
	 * Set Language
	 *
	 * Sets the main language international code and its file
	 * in their respective variables.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function set_lang($lang = NULL)
	{
		$this->_main_lang = $lang;
		$this->_loaded_files[$lang] = array();
		$this->_lang_lines[$lang] = array();
		return TRUE;
	}

	/**
	 * Set Base Language
	 *
	 * Sets the base language international code and its file
	 * in their respective variables.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function set_base_lang($lang = NULL)
	{
		$this->_base_lang = $lang;
		$this->_loaded_files[$lang] = array();
		$this->_lang_lines[$lang] = array();
		return TRUE;
	}

	/**
	 * Get Language
	 *
	 * Returns the main language international code.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_lang()
	{
		return $this->_main_lang;
	}

	/**
	 * Get Base Language
	 *
	 * Returns the base language international code.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_base_lang()
	{
		return $this->_base_lang;
	}

	/**
	 * Load File
	 *
	 * Reads the main language file and load its contents into the $lang_lines array.
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function load_file($file, $setlang = NULL)
	{
		if (isset($setlang) && !isset($this->_main_lang)) {
			$this->set_lang($setlang);
		} elseif (!isset($setlang) && isset($this->_main_lang)) {
			$setlang = $this->_main_lang;
		} else {
			trigger_error('Main language not set.', E_USER_WARNING);
			return FALSE;
		}

		if (isset($setlang) && !array_key_exists($setlang, $this->_lang_lines)) {
			$this->_lang_lines[$setlang] = array();
		}

		if ($this->_loadable_file($file . '.php')) {
			if (!isset($this->_lang_lines[$this->_main_lang])) {
				$this->_lang_lines[$this->_main_lang] = array();
			}

			require_once($this->_lang_folder . $this->_main_lang . '/' . $file . '.php');

			$this->_loaded_files[$setlang][] = $file . '.php';

			$this->_lang_lines[$this->_main_lang] = array_merge($this->_lang_lines[$this->_main_lang], $lang);
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Load Base
	 *
	 * Reads the base language file and load its contents into the $lang_lines array.
	 *
	 * @access	private
	 * @return	bool
	 */
	private function _load_base()
	{
		$files = array_diff($this->_loaded_files[$this->_main_lang], $this->_loaded_files[$this->_base_lang]);

		if (isset($files)) {
			foreach ($files as $file) {
				if ($this->_loadable_file($file, $this->_base_lang)) {
					require_once($this->_lang_folder . $this->_base_lang . '/' . $file);
					$this->_loaded_files[$this->_base_lang][] = $file;
					$this->_lang_lines[$this->_base_lang] = array_merge($this->_lang_lines[$this->_base_lang], $lang);
				}
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Line
	 *
	 * Returns the language line assigned to the inserted key.
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function line($ln = NULL)
	{
		if (!isset($ln)) {
			return FALSE;
		}
		// Is the key in the main_lang array?
		if (array_key_exists($ln, $this->_lang_lines[$this->_main_lang])) {
			return $this->_lang_lines[$this->_main_lang][$ln];
		// Or is it in the base_lang array?
		} elseif (isset($this->_base_lang)) {
			$this->_load_base();
			if (isset($this->_lang_lines[$this->_base_lang][$ln])) {
				return $this->_lang_lines[$this->_base_lang][$ln];
			} else {
				return FALSE;
			}
		} else {
			trigger_error('Language line "' . $ln . '" does not exist.', E_USER_WARNING);
			return FALSE;
		}
	}

	/**
	 * Lines
	 *
	 * Returns the whole language array.
	 *
	 * @access	public
	 * @return	array
	 */
	public function lines()
	{
		if (!isset($this->_lang_lines[$this->_main_lang])) {
			return FALSE;
		}

		if (isset($this->_base_lang)) {
			$this->_load_base();
			return array_merge($this->_lang_lines[$this->_base_lang], $this->_lang_lines[$this->_main_lang]);
		} else {
			return $this->_lang_lines[$this->_main_lang];
		}
	}

	/**
	 * Loadable File
	 *
	 * Does the language file exist?
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	private function _loadable_file($filename = NULL, $lang = NULL)
	{
		if (!isset($lang)) {
			$lang = $this->_main_lang;
		}

		if (in_array($filename, $this->_loaded_files[$lang])) {
			return FALSE;
		}

		if (!is_dir($this->_lang_folder)) {
			trigger_error('"' . $this->_lang_folder . '" folder does not exist.', E_USER_WARNING);
			return FALSE;
		}

		if (!is_dir($this->_lang_folder . $lang)) {
			trigger_error('Language "' . $lang . '" not found in "' . $this->_lang_folder . '" folder.', E_USER_WARNING);
			return FALSE;
		}

		if (!file_exists($this->_lang_folder . $lang . '/' . $filename)) {
			trigger_error('Language file "' . $filename . '" not found in "' . $this->_lang_folder . '" folder.', E_USER_WARNING);
			return FALSE;
		}

		return TRUE;
	}
}
