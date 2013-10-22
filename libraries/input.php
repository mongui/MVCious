<?php if ( !defined('MVCious')) exit('No direct script access allowed');
/**
 * Input Class
 *
 * Analyzes and cleans global vars.
 *
 * @package		MVCious
 * @subpackage	Libraries
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */
class Input
{
	/**
	 * Clean Var
	 *
	 * Filters the global variables sent by the user and returns them
	 * in their respective types.
	 *
	 * @access	private
	 * @param	string
	 * @param 	string
	 * @return	mixed
	 */
	private function _clean_var($dirtyvar, $type = NULL)
	{
		if (!isset($dirtyvar)) {
			return FALSE;
		}

		if (!isset($type)) {
			if (is_array($dirtyvar)															) {
				$type = 'array';
			} elseif ((string)(int)$dirtyvar == $dirtyvar									) {
				$type = 'int';
			} elseif ((string)(float)$dirtyvar == $dirtyvar									) {
				$type = 'float';
			} elseif (strtolower($dirtyvar) == 'true' || strtolower($dirtyvar) == 'false'	) {
				$type = 'boolean';
			} else {
				$type = 'string';
			}
		}

		switch ($type) {
			case 'boolean':	$cleanvar = (boolean)filter_var($dirtyvar, FILTER_VALIDATE_BOOLEAN);								break;
			case 'int':		$cleanvar = (int)filter_var($dirtyvar, FILTER_SANITIZE_NUMBER_INT);									break;
			case 'float':	$cleanvar = (float)filter_var($dirtyvar, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	break;
			case 'email':	$cleanvar = filter_var($dirtyvar, FILTER_VALIDATE_EMAIL);											break;
			case 'ip':		$cleanvar = filter_var($dirtyvar, FILTER_VALIDATE_IP);												break;
			case 'url':		$cleanvar = filter_var($dirtyvar, FILTER_VALIDATE_URL);												break;
			case 'array':
				foreach ($dirtyvar as $n => $d)
					$cleanvar[$n]     = $this->_clean_var($d);
			break;
			case 'string':
			default:		$cleanvar = filter_var($dirtyvar, FILTER_SANITIZE_STRING);											break;
		}

		return $cleanvar;
	}

	/**
	 * Post
	 *
	 * Returns a filtered item or the entire array $_POST.
	 *
	 * @access	public
	 * @param	string
	 * @param 	string
	 * @return	mixed
	 */
	public function post($dirtyvar = NULL, $type = NULL)
	{
		if (!isset($dirtyvar)								) {
			return $this->_clean_var($_POST);
		} elseif (isset($_POST[$dirtyvar])					) {
			return $this->_clean_var($_POST[$dirtyvar], $type);
		} else {
			return FALSE;
		}
	}

	/**
	 * Get
	 *
	 * Returns a filtered item or the entire array $_GET.
	 *
	 * @access	public
	 * @param	string
	 * @param 	string
	 * @return	mixed
	 */
	public function get($dirtyvar = NULL, $type = NULL)
	{
		if (!isset($dirtyvar)								) {
			return $this->_clean_var($_GET);
		} elseif (isset($_GET[$dirtyvar])					) {
			return $this->_clean_var($_GET[$dirtyvar], $type);
		} else {
			return FALSE;
		}
	}

	/**
	 * Server
	 *
	 * Returns a filtered item or the entire array $_SERVER.
	 *
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	public function server($dirtyvar = NULL)
	{
		if (!isset($dirtyvar)								) {
			return $this->_clean_var($_SERVER);
		} elseif (isset($_SERVER[$dirtyvar])				) {
			return $this->_clean_var($_SERVER[$dirtyvar]);
		} else {
			return FALSE;
		}
	}

	/**
	 * Cookie
	 *
	 * Returns a filtered item or the entire array $_COOKIE.
	 *
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	public function cookie($dirtyvar = NULL)
	{
		if (!isset($dirtyvar)								) {
			return $this->_clean_var($_COOKIE);
		} elseif (isset($_COOKIE[$dirtyvar])				) {
			return $this->_clean_var($_COOKIE[$dirtyvar]);
		} else {
			return FALSE;
		}
	}

	/**
	 * Client IP
	 *
	 * Returns the user IP address.
	 *
	 * @access	public
	 * @return	string
	 */
	public function client_ip()
	{
		if (getenv('HTTP_CLIENT_IP')						) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('HTTP_X_FORWARDED_FOR')			) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} elseif (getenv('HTTP_X_FORWARDED')				) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} elseif (getenv('HTTP_FORWARDED_FOR')				) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} elseif (getenv('HTTP_FORWARDED')					) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} elseif (getenv('REMOTE_ADDR')						) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			return FALSE;
		}

		return $this->_clean_var($ipaddress, 'ip');
	}
}
