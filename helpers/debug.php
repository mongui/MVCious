<?php if (!defined('MVCious')) exit('No direct script access allowed');
/**
 * Debug helpers
 *
 * @package		MVCious
 * @subpackage	Helpers
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */

// ---------------------------------------------------------------------------

/**
 * Dump
 *
 * Offers more info than var_dump.
 *
 * @access	public
 * @return	void
 */
if (!function_exists('dump')) {
	function dump()
	{
		list($callee) = debug_backtrace();
		$arguments = func_get_args();
		$total_arguments = count($arguments);

		echo '<fieldset style="background:#FEFEFE !important; border:2px red solid; padding:0 15px; border-radius:10px;">';
		echo '<legend style="background:lightgrey; border-radius:10px; margin-left:5px; padding:2px 7px;">' . $callee['file'] . ' @ line: ' . $callee['line'] . '</legend><pre>';
		$i = 0;
		foreach ($arguments as $argument) {
			if ($i>0) {
				echo '<br />';
			}
			echo '<strong>Debug #' . (++$i) . ' of ' . $total_arguments . '</strong>: ';
			print_r($argument);
			if (!is_array($argument)) {
				print_r(' <span style="font-size:80%">(' . gettype($argument) . ': ' . strlen($argument) . ')</span>');
			}
		}
		echo '</pre>';
		echo '</fieldset>';
	}
}
