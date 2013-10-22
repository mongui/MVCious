<?php if ( !defined('MVCious')) exit('No direct script access allowed');
/**
 * Email Class
 *
 * Email sender that uses Sendmail and IMAP.
 *
 * @package		MVCious
 * @subpackage	Libraries
 * @author		Gontzal Goikoetxea
 * @link		https://github.com/mongui/MVCious
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 */
class Email
{
	/**
	 * @var		string
	 * @access	private
	 */
	private $_email_method	= 'sendmail'; // sendmail or imap.

	/**
	 * @var		string
	 * @access	private
	 */
	private $_email_subject	= '';

	/**
	 * @var		string
	 * @access	private
	 */
	private $_email_body	= '';

	/**
	 * @var		string
	 * @access	private
	 */
	private $_email_from	= '';

	/**
	 * @var		array
	 * @access	private
	 */
	private $_email_to		= array();

	/**
	 * @var		array
	 * @access	private
	 */
	private $_email_cc		= array();

	/**
	 * @var		array
	 * @access	private
	 */
	private $_email_bcc		= array();

	/**
	 * Set Method
	 *
	 * Set the email delivery method.
	 *
	 * @access	public
	 * @param 	string
	 * @return	bool
	 */
	public function set_method($method)
	{
		if ($this->is_available($method)) {
			$this->_email_method = $method;
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Get Method
	 *
	 * Return the email delivery method used.
	 *
	 * @access	public
	 * @param 	string
	 * @return	bool
	 */
	public function get_method()
	{
		return $this->_email_method;
	}

	/**
	 * Validate Email
	 *
	 * Filters the email and checks if is valid.
	 *
	 * @access	private
	 * @param 	string
	 * @return	string
	 */
	private function _validate_email($email = FALSE)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * From
	 *
	 * Sets the sender of the email.
	 *
	 * @access	public
	 * @param 	string
	 * @param 	string
	 * @return	bool
	 */
	public function from($email, $name = NULL)
	{
		if ($this->_validate_email($email)) {
			if (isset($name)) {
				$this->_email_from = $name . ' <' . $email . '>';
			} else {
				$this->_email_from = $email;
			}

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get From
	 *
	 * Returns previously added sender.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_from()
	{
		return $this->_email_from;
	}

	/**
	 * To
	 *
	 * Sets who the mail is for.
	 *
	 * @access	public
	 * @param 	string
	 * @param 	string
	 * @return	bool
	 */
	public function to($email, $name = NULL)
	{
		if ($this->_validate_email($email)) {
			if (isset($name)) {
				$this->_email_to[] = $name . ' <' . $email . '>';
			} else {
				$this->_email_to[] = $email;
			}

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get To
	 *
	 * Returns previously added target recipient.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_to()
	{
		return $this->_email_to;
	}

	/**
	 * CC
	 *
	 * Sets who is going to receive a copy of the email.
	 *
	 * @access	public
	 * @param 	string
	 * @param 	string
	 * @return	bool
	 */
	public function cc($email, $name = NULL)
	{
		if ($this->_validate_email($email)) {
			if (isset($name)) {
				$this->_email_cc[] = $name . ' <' . $email . '>';
			} else {
				$this->_email_cc[] = $email;
			}

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get CC
	 *
	 * Returns the receiver of a copy of the email.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_cc()
	{
		return $this->_email_cc;
	}

	/**
	 * BCC
	 *
	 * Sets who is going to receive a hidden copy of the email.
	 *
	 * @access	public
	 * @param 	string
	 * @param 	string
	 * @return	bool
	 */
	public function bcc($email, $name = NULL)
	{
		if ($this->_validate_email($email)) {
			if (isset($name)) {
				$this->_email_bcc[] = $name . ' <' . $email . '>';
			} else {
				$this->_email_bcc[] = $email;
			}

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get BCC
	 *
	 * Returns the receiver of a hidden copy of the email.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_bcc()
	{
		return $this->_email_bcc;
	}

	/**
	 * Subject
	 *
	 * Sets the subject of the email.
	 *
	 * @access	public
	 * @param 	string
	 * @return	bool
	 */
	public function subject($subject = NULL)
	{
		if (isset($subject)) {
			$this->_email_subject = $subject;
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get Subject
	 *
	 * Returns previously added subject of the email.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_subject()
	{
		return $this->_email_subject;
	}

	/**
	 * Body
	 *
	 * Sets the body of the email.
	 *
	 * @access	public
	 * @param 	string
	 * @return	bool
	 */
	public function body($body = NULL)
	{
		if (isset($body)) {
			$this->_email_body = $body;
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	/**
	 * Get Body
	 *
	 * Returns previously added body of the email.
	 *
	 * @access	public
	 * @return	string
	 */
	public function get_body()
	{
		return $this->_email_body;
	}

	/**
	 * Is Available
	 *
	 * Checks if the selected delivery method is available.
	 *
	 * @access	public
	 * @param 	string
	 * @return	bool
	 */
	public function is_available($method)
	{
		if (!isset($method)) {
			return FALSE;
		}

		// Is available one of these: sendmail, imap?
		if ($method == 'sendmail') {
			$getSendMailPath = ini_get('sendmail_path');

			if ($getSendMailPath) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * Send
	 *
	 * Checks if the retreived data is OK and sends the email.
	 *
	 * @access	public
	 * @param 	string
	 * @param 	string
	 * @return	bool
	 */
	public function send($subject = NULL, $body = NULL)
	{
		if (!isset($subject) && $this->_email_subject == '') {
			return FALSE;
		} elseif (!isset($body) && $this->_email_body == '') {
			return FALSE;
		} elseif (count($this->_email_to) == 0) {
			return FALSE;
		}

		$subject	= (isset($suject))			? $subject				: $this->_email_subject;
		$body		= (isset($body))			? $body					: $this->_email_body;
		$from		= ($this->_email_from != '')? $this->_email_from	: 'admin@' . $this->config->get('server_host');
		$to			= $this->_email_to[0];

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		if (count($this->_email_to) > 1) {
			$headers .= 'To: ' . implode(', ', $this->_email_to) . "\r\n";
		}
		if (count($this->_email_cc) > 0) {
			$headers .= 'Cc: ' . implode(', ', $this->_email_cc) . "\r\n";
		}
		if (count($this->_email_bcc) > 0) {
			$headers .= 'Bcc: ' . implode(', ', $this->_email_bcc) . "\r\n";
		}
		
		switch ($this->_email_method) {
			case 'imap':
				$done = imap_mail($to, $subject, $body, $headers);
			break;
			case 'sendmail':
				$done = mail($to, $subject, $body, $headers);
			break;
		}

		return $done;
	}

}