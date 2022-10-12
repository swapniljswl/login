<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_CSRF {
	/**
	 * CSRF Hash
	 *
	 * Random hash for Cross Site Request Forgery protection cookie
	 *
	 * @var	string
	 */
	protected $_csrf_hash;
	/**
	 * CSRF Token name
	 *
	 * Token name for Cross Site Request Forgery protection session variable.
	 *
	 * @var	string
	 */
	protected $_csrf_session_name =	'ci_csrf_token';
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	/**
	 * CSRF Token name
	 *
	 * Token name for Cross Site Request Forgery protection cookie.
	 *
	 * @var	string
	 */
	protected $_csrf_token_name =	'ci_csrf_token';

	public function __construct()
	{
		// Is CSRF protection enabled?
		if (config_item('custom_csrf_protection'))
		{
			// CSRF config
			foreach (array('csrf_token_name', 'csrf_session_name') as $key)
			{
				if (NULL !== ($val = config_item($key)))
				{
					$this->{'_'.$key} = $val;
				}
			}

			// Append application specific cookie prefix
			if ($cookie_prefix = config_item('cookie_prefix'))
			{
				$this->_csrf_session_name = $cookie_prefix.$this->_csrf_session_name;
			}

			// Set the CSRF hash
			$this->_csrf_set_hash();
		}

		$this->charset = strtoupper(config_item('charset'));

		log_message('info', 'Security Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * CSRF Verify using Session
	 *
	 * @return	CI_Security
	 */
	public function csrf_verify()
	{
		if(config_item('custom_csrf_protection'))
		{
			// Check if URI has been whitelisted from CSRF checks
			if ($exclude_uris = config_item('csrf_exclude_uris'))
			{
				$uri = load_class('URI', 'core');
				foreach ($exclude_uris as $excluded)
				{
					if (preg_match('#^'.$excluded.'$#i'.(UTF8_ENABLED ? 'u' : ''), $uri->uri_string()))
					{
						return true;
					}
				}
			}

			// Check CSRF token validity, but don't error on mismatch just yet - we'll want to regenerate
			$valid = (isset($_POST[$this->_csrf_token_name], $_SESSION[$this->_csrf_session_name]) && hash_equals($_POST[$this->_csrf_token_name], $_SESSION[$this->_csrf_session_name]));
			
			// We kill this since we're done and we don't want to pollute the _POST array
			unset($_POST[$this->_csrf_token_name]);

			// Regenerate on every submission?
			if (config_item('custom_csrf_regenerate'))
			{
				// Nothing should last forever
				unset($_SESSION[$this->_csrf_session_name]);
				$this->_csrf_hash = NULL;
			}

			$this->_csrf_set_hash();
			$this->csrf_set_session();
			if (!$valid)
			{
				$this->csrf_show_error();
			}
			else
				return true;
		}
		else
			return true;		

	}


	// --------------------------------------------------------------------

	/**
	 * CSRF Set Session
	 *
	 * @codeCoverageIgnore
	 * @return	CI_Security
	 */
	public function csrf_set_session()
	{
		$_SESSION[$this->_csrf_session_name]=$this->_csrf_hash;
		log_message('info', 'CSRF session set');

	}

	// --------------------------------------------------------------------
	/**
	 * Set CSRF Hash and Cookie
	 *
	 * @return	string
	 */
	protected function _csrf_set_hash()
	{
		if ($this->_csrf_hash === NULL)
		{
			// If the cookie exists we will use its value.
			// We don't necessarily want to regenerate it with
			// each page load since a page could contain embedded
			// sub-pages causing this feature to fail
			if (isset($_SESSION[$this->_csrf_session_name]) && is_string($_SESSION[$this->_csrf_session_name])
				&& preg_match('#^[0-9a-f]{32}$#iS', $_SESSION[$this->_csrf_session_name]) === 1)
			{
				return $this->_csrf_hash = $_SESSION[$this->_csrf_session_name];
			}

			$rand = $this->get_random_bytes(16);
			$this->_csrf_hash = ($rand === FALSE)
				? md5(uniqid(mt_rand(), TRUE))
				: bin2hex($rand);
		}

		return $this->_csrf_hash;
	}

	/**
	 * Show CSRF Error
	 *
	 * @return	void
	 */
	public function csrf_show_error()
	{
		show_error('The action you have requested is not allowed.', 403);
		return false;
	}

	// --------------------------------------------------------------------

	/**
	 * Get CSRF Hash
	 *
	 * @see		CI_Security::$_csrf_hash
	 * @return 	string	CSRF hash
	 */
	public function get_csrf_hash()
	{
		return $this->_csrf_hash;
	}

	// --------------------------------------------------------------------

	/**
	 * Get CSRF Token Name
	 *
	 * @see		CI_Security::$_csrf_token_name
	 * @return	string	CSRF token name
	 */
	public function get_csrf_token_name()
	{
		return $this->_csrf_token_name;
	}

	// --------------------------------------------------------------------
	/**
	 * Get random bytes
	 *
	 * @param	int	$length	Output length
	 * @return	string
	 */
	public function get_random_bytes($length)
	{
		if (empty($length) OR ! ctype_digit((string) $length))
		{
			return FALSE;
		}

		if (function_exists('random_bytes'))
		{
			try
			{
				// The cast is required to avoid TypeError
				return random_bytes((int) $length);
			}
			catch (Exception $e)
			{
				// If random_bytes() can't do the job, we can't either ...
				// There's no point in using fallbacks.
				log_message('error', $e->getMessage());
				return FALSE;
			}
		}

		// Unfortunately, none of the following PRNGs is guaranteed to exist ...
		if (defined('MCRYPT_DEV_URANDOM') && ($output = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM)) !== FALSE)
		{
			return $output;
		}


		if (is_readable('/dev/urandom') && ($fp = fopen('/dev/urandom', 'rb')) !== FALSE)
		{
			// Try not to waste entropy ...
			is_php('5.4') && stream_set_chunk_size($fp, $length);
			$output = fread($fp, $length);
			fclose($fp);
			if ($output !== FALSE)
			{
				return $output;
			}
		}

		if (function_exists('openssl_random_pseudo_bytes'))
		{
			return openssl_random_pseudo_bytes($length);
		}

		return FALSE;
	}

	// --------------------------------------------------------------------
	public function csrf_verify_with_param($csrf_token=null)
	{
		if(config_item('custom_csrf_protection'))
		{
			// Check if URI has been whitelisted from CSRF checks
			if ($exclude_uris = config_item('csrf_exclude_uris'))
			{
				$uri = load_class('URI', 'core');
				foreach ($exclude_uris as $excluded)
				{
					if (preg_match('#^'.$excluded.'$#i'.(UTF8_ENABLED ? 'u' : ''), $uri->uri_string()))
					{
						return true;
					}
				}
			}

			// Check CSRF token validity, but don't error on mismatch just yet - we'll want to regenerate
			$valid = (isset($_SESSION[$this->_csrf_session_name]) && hash_equals($csrf_token, $_SESSION[$this->_csrf_session_name]));
			
			
			// Regenerate on every submission?
			if (config_item('custom_csrf_regenerate'))
			{
				// Nothing should last forever
				unset($_SESSION[$this->_csrf_session_name]);
				$this->_csrf_hash = NULL;
			}

			$this->_csrf_set_hash();
			$this->csrf_set_session();
			if (!$valid)
			{
				$this->csrf_show_error();
			}
			else
				return true;
		}
		else
			return true;		

	}
}