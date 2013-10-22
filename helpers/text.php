<?php if ( !defined('MVCious')) exit('No direct script access allowed');
/**
 * Text helpers
 *
 * @package		MVCious
 * @subpackage	Helpers
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */

// ---------------------------------------------------------------------------

/**
 * Max. Chars
 *
 * Cuts a string to the maximum of characters desired.
 * If $dots is TRUE, adds an ellipsis at the end of the string.
 *
 * @access	public
 * @param	string
 * @param 	integer
 * @param 	bool
 * @return	string
 */
if (!function_exists('max_chars')) {
	function max_chars($text = NULL, $chars = 0, $dots = TRUE)
	{
		if (!is_string($text)) {
			return FALSE;
		}

		$text = ltrim($text);

		if (strlen($text) > $chars) {
			if ($dots) {
				$text = rtrim(substr($text, 0, $chars-3));
				return $text . '...';
			} else {
				$text = rtrim(substr($text, 0, $chars));
				return $text;
			}
		} else {
			return $text;
		}
	}
}

/**
 * Max. Words
 *
 * Cuts a string to the maximum of words desired.
 * If $dots is TRUE, adds an ellipsis at the end of the string.
 *
 * @access	public
 * @param	string
 * @param 	integer
 * @param 	bool
 * @return	string
 */
if (!function_exists('max_words')) {
	function max_words($text, $words = 0, $dots = TRUE)
	{
		if (!is_string($text)) {
			return FALSE;
		}

		$text = trim($text);
		$word_array = explode(' ', $text);
		$word_array = array_filter($word_array);

		if(sizeof($word_array) > $words) {
			$word_array = array_slice($word_array, 0, $words);
			$text = implode(' ', $word_array);

			if ($dots) {
				return $text . '...';
			} else {
				return $text;
			}
		} else {
			return array($text);
		}
	}
}

/**
 * String Generator
 *
 * Builds a string of a fixed size.
 *
 * @access	public
 * @param 	integer
 * @param 	bool
 * @return	string
 */
if (!function_exists('string_generator')) {
	function string_generator($size = 20, $case = TRUE)
	{
		$var = '';

		if ($case) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		} else {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		}
		
		for ($i = 0; $i < $size; $i++) {
			$var .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		}
		
		return $var;
	}
}
