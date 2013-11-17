<?php if (!defined('MVCious')) exit('No direct script access allowed');
/**
 * HTML helpers
 *
 * @package		MVCious
 * @subpackage	Helpers
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */

// ---------------------------------------------------------------------------

/**
 * HTML Replace
 *
 * Looks for vars marked between $delimiters in the HTML file and replaces them.
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	bool
 * @param	string
 * @return	string
 */
if (!function_exists('html_parse')) {
	function html_parse($filename, $vars = NULL, $return = FALSE, $delimiters = '{}')
	{
		$inst =& get_instance();
		$text = $inst->load->view($filename, $vars, TRUE);

		if (   is_array($vars)
			&& count($vars) > 0
			&& strlen($delimiters)%2 == 0
		) {
			$a = strlen($delimiters) / 2;
			$repstart = substr($delimiters, 0, $a);
			$repend = substr($delimiters, $a);

			foreach ($vars as $key => $var) {
				$text = str_replace($repstart . $key . $repend, $var, $text);
			}
		}

		if ($return) {
			return $text;
		} else {
			echo $text;
			return TRUE;
		}
	}
}
