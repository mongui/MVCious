<?php if (!defined('MVCious')) exit('No direct script access allowed');
/**
 * File Class
 *
 * XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *
 * @package		MVCious
 * @subpackage	Libraries
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */
class File
{
	private $_filename = '';

	public function read($filename = NULL, $line = NULL)
	{
		//$this->_filename

		$file_handle = fopen($filename, 'r');
		$ln = '';

		if (is_numeric($line)) {
			$count = 1;
			while (!feof($file_handle)) {
				if ($line == $count) {
					$ln = fgets($file_handle);
					break;
				}

				fgets($file_handle);
				$count++;
			}
		} else {
			$ln = fread($file_handle, filesize($filename));
		}

		fclose($file_handle);

		return $ln;
	}

	public function write($filename, $text, $append = FALSE)
	{
		if (!$this->exist($filename)) {
			return FALSE;
		}
		if (isset($append) && $append == TRUE) {
			$file_handle = fopen($filename, 'a');
		} else {
			$file_handle = fopen($filename, 'w');
		}

		fwrite($file_handle, $text);
		fclose($file_handle);
	}

	public function exist($filename)
	{
		return file_exists($filename);
	}

	public function delete($filename)
	{
		if ($this->exist($filename)) {
			unlink($filename);
		}
	}

	public function copy($src, $dst, $overwrite = FALSE)
	{
		if (
			   $this->exist($dst) == FALSE
			|| $overwrite == TRUE
			&& (isset($src) && isset($dst))
		) {
			return copy($src, $dst);
		} else {
			return FALSE;
		}
	}

	public function rename($old_filename, $new_filename, $overwrite = FALSE)
	{
		if (
			   $this->exist($new_filename) == FALSE
			|| $overwrite == TRUE
			&& (isset($src) && isset($dst))
		) {
			return rename($old_filename, $new_filename);
		} else {
			return FALSE;
		}
	}

	public function move($src, $dst, $overwrite = FALSE)
	{
		return $this->rename($src, $dst, $overwrite);
	}

/*
	public function info($filename)
	{

	}

	public function list($folder)
	{

	}

	public function parse_ini($filename)
	{
	
	}
*/
}
