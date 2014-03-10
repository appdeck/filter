<?php
/**
* User data sanitization and validation
*
* @copyright 2014 appdeck
* @link http://github.com/appdeck/filter
* @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
*/

namespace Filter;

use Filter\Exception;

class Filter {

	/**
	 * Returns a boolean value
	 *
	 * @return bool
	 */
	public static function bool() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::bool($argument);
			return $arguments;
		}
		if (is_numeric($arguments[0]))
			return ($arguments[0] > 0.0);
		if (is_bool($arguments[0]))
			return $arguments[0];
		return in_array(self::string($arguments[0]), array('true', 't', 'yes'));
	}

	/**
	 * Returns an integer value
	 *
	 * @return int
	 */
	public static function int() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::int($argument);
			return $arguments;
		}
		return intval(filter_var($arguments[0], FILTER_SANITIZE_NUMBER_INT));
	}

	/**
	 * Returns a float value
	 *
	 * @return float
	 */
	public static function float() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::float($argument);
			return $arguments;
		}
		return floatval(filter_var($arguments[0], FILTER_SANITIZE_NUMBER_FLOAT, (FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND)));
	}

	/**
	 * Returns a string value
	 *
	 * @return string
	 */
	public static function string() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::string($argument);
			return $arguments;
		}
		return (string)filter_var($arguments[0], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_NO_ENCODE_QUOTES);
	}

	/**
	 * Returns a string value without HTML tags
	 *
	 * @return string
	 */
	public static function noTags() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::notags($argument);
			return $arguments;
		}
		return (string)filter_var($arguments[0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_NO_ENCODE_QUOTES);
	}

	/**
	 * Returns an email value
	 *
	 * @return string|null
	 */
	public static function email() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::email($argument);
			return $arguments;
		}
		$arguments[0] = filter_var($arguments[0], FILTER_SANITIZE_EMAIL);
		if (filter_var($arguments[0], FILTER_VALIDATE_EMAIL))
			return $arguments[0];
		return null;
	}

	/**
	 * Returns an URL value
	 *
	 * @return string|null
	 */
	public static function url() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::url($argument);
			return $arguments;
		}
		$arguments[0] = filter_var($arguments[0], FILTER_SANITIZE_URL);
		if (filter_var($arguments[0], FILTER_VALIDATE_URL))
			return $arguments[0];
		return null;
	}

	/**
	 * Returns a date value
	 *
	 * @return string|null
	 */
	public static function date() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::date($argument);
			return $arguments;
		}
		$arguments[0] = preg_replace('/[^0-9\/\-\.]+/', '', self::string($arguments[0]));
		//ddmmyyyy
		if (preg_match('/^(0[1-9]|[1|2][0-9]|3[0|1])[\/|\-|\.]?(0[1-9]|1[0-2])[\/|\-|\.]?([1|2][0-9]{3})$/', $arguments[0], $matches))
			return "{$matches[3]}/{$matches[2]}/{$matches[1]}";
		//mmddyyyy
		if (preg_match('/^(0[1-9]|1[0-2])[\/|\-|\.]?(0[1-9]|[1|2][0-9]|3[0|1])[\/|\-|\.]?([1|2][0-9]{3})$/', $arguments[0], $matches))
			return "{$matches[3]}/{$matches[1]}/{$matches[2]}";
		//yyyymmdd
		if (preg_match('/^([1|2][0-9]{3})[\/|\-|\.]?(0[1-9]|1[0-2])[\/|\-|\.]?(0[1-9]|[1|2][0-9]|3[0|1])$/', $arguments[0], $matches))
			return "{$matches[1]}/{$matches[2]}/{$matches[3]}";
		return null;
	}

	/**
	 * Returns an IPv4 value
	 *
	 * @return string|null
	 */
	public static function ipv4() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::ipv4($argument);
			return $arguments;
		}
		$arguments[0] = preg_replace('/[^0-9\.\/]+/', '', self::string($arguments[0]));
		if (filter_var($arguments[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
			return $arguments[0];
		return null;
	}

	/**
	 * Returns an IPv6 value
	 *
	 * @return string|null
	 */
	public static function ipv6() {
		$arguments = func_get_args();
		if (count($arguments) > 1) {
			foreach ($arguments as &$argument)
				$argument = self::ipv6($argument);
			return $arguments;
		}
		$arguments[0] = preg_replace('/[^0-9a-f:]+/', '', self::string($arguments[0]));
		if (filter_var($arguments[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
			return $arguments[0];
		return null;
	}

}