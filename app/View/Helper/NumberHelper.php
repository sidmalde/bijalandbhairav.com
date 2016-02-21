<?php
/**
 * Number Helper.
 *
 * Methods to make numbers more readable.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Helper
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('CakeNumber', 'Utility');
App::uses('AppHelper', 'View/Helper');
App::uses('Hash', 'Utility');

/**
 * Number helper library.
 *
 * Methods to make numbers more readable.
 *
 * @package       Cake.View.Helper
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html
 * @see CakeNumber
 */
class NumberHelper extends AppHelper {
	
	var $_currencies = array(
		'USD' => array(
			'before' => '$', 'after' => 'c', 'zero' => '$0', 'places' => 2, 'thousands' => ',',
			'decimals' => '.', 'negative' => '-', 'escape' => true
		),
		'GBP' => array(
			'before'=>'&#163;', 'after' => 'p', 'zero' => '&#163;0', 'places' => 2, 'thousands' => ',',
			'decimals' => '.', 'negative' => '-','escape' => false
		),
		'EUR' => array(
			'before'=> false, 'after' => ' &#8364;', 'zero' => '0 &#8364;', 'places' => 2, 'thousands' => ' ',
			'decimals' => ',', 'negative' => '-', 'escape' => false
		),
		'CHF' => array(
			'before'=> 'CHF ', 'after' => false, 'zero' => 'CHF 0', 'places' => 2, 'thousands' => '\'',
			'decimals' => ',', 'negative' => '-', 'escape' => false
		),
		'EURNL' => array(
			'before'=> '&#8364; ', 'after' => false, 'zero' => '&#8364; 0', 'places' => 2, 'thousands' => '.',
			'decimals' => ',', 'negative' => '-', 'escape' => false
		),
		'EURDE' => array(
			'before'=> false, 'after' => ' &#8364;', 'zero' => '0 &#8364;', 'places' => 2, 'thousands' => '.',
			'decimals' => ',', 'negative' => '-', 'escape' => false
		),
		'EURIE' => array(
			'before'=> '&#8364;', 'after' => false, 'zero' => '&#8364;0', 'places' => 2, 'thousands' => ',',
			'decimals' => '.', 'negative' => '-', 'escape' => false
		)
	);

/**
 * Default options for currency formats
 *
 * @var array
 * @access protected
 */
	var $_currencyDefaults = array(
		'before'=>'', 'after' => '', 'zero' => '0', 'places' => 2, 'thousands' => ',',
		'decimals' => '.','negative' => '()', 'escape' => true
	);
	
	
/**
 * CakeNumber instance
 *
 * @var CakeNumber
 */
	protected $_engine = null;

/**
 * Default Constructor
 *
 * ### Settings:
 *
 * - `engine` Class name to use to replace CakeNumber functionality
 *            The class needs to be placed in the `Utility` directory.
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper
 * @throws CakeException When the engine class could not be found.
 */
	public function __construct(View $View, $settings = array()) {
		$settings = Hash::merge(array('engine' => 'CakeNumber'), $settings);
		parent::__construct($View, $settings);
		list($plugin, $engineClass) = pluginSplit($settings['engine'], true);
		App::uses($engineClass, $plugin . 'Utility');
		if (class_exists($engineClass)) {
			$this->_engine = new $engineClass($settings);
		} else {
			throw new CakeException(__d('cake_dev', '%s could not be found', $engineClass));
		}
	}

/**
 * Call methods from CakeNumber utility class
 */
	public function __call($method, $params) {
		return call_user_func_array(array($this->_engine, $method), $params);
	}

/**
 * @see CakeNumber::precision()
 *
 * @param float $number A floating point number.
 * @param integer $precision The precision of the returned number.
 * @return float Formatted float.
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html#NumberHelper::precision
 */
	public function precision($number, $precision = 3) {
		return $this->_engine->precision($number, $precision);
	}

/**
 * @see CakeNumber::toReadableSize()
 *
 * @param integer $size Size in bytes
 * @return string Human readable size
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html#NumberHelper::toReadableSize
 */
	public function toReadableSize($size) {
		return $this->_engine->toReadableSize($size);
	}
	/**
	 * Formats month and years
	 * @param integer $duration The duration of the order
	 * return months of years in the correct language
	 */
	 function duration($duration){
		switch($duration){
			case 0:
				return __('1 month');
			break;
			case 1:
				return __('1 year');
			break;
			default:
				return __('%s years', $duration);
			break; 
		}
	 }
/**
 * @see CakeNumber::toPercentage()
 *
 * @param float $number A floating point number
 * @param integer $precision The precision of the returned number
 * @param array $options Options
 * @return string Percentage string
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html#NumberHelper::toPercentage
 */
	public function toPercentage($number, $precision = 2, $options = array()) {
		return $this->_engine->toPercentage($number, $precision, $options);
	}
	
	function format($number, $options = false) {
		$places = 0;
		if (is_int($options)) {
			$places = $options;
		}

		$separators = array(',', '.', '-', ':');

		$before = $after = null;
		if (is_string($options) && !in_array($options, $separators)) {
			$before = $options;
		}
		$thousands = ',';
		if (!is_array($options) && in_array($options, $separators)) {
			$thousands = $options;
		}
		$decimals = '.';
		if (!is_array($options) && in_array($options, $separators)) {
			$decimals = $options;
		}

		$escape = true;
		if (is_array($options)) {
			$options = array_merge(array('before'=>'$', 'places' => 2, 'thousands' => ',', 'decimals' => '.'), $options);
			extract($options);
		}

		$out = $before . number_format($number, $places, $decimals, $thousands) . $after;

		if ($escape) {
			return h($out);
		}
		return $out;
	}
	
	
	function currency($number, $currency = NULL, $options = array()) {
		if($currency === NULL){
			$currency = strtoupper(Configure::read('Config.currency'));	
		}
		$test = explode('.', $number);
		if(count($test) > 1){
			list($whole, $decimal) = explode('.', $number);
			if($decimal == 0){
				$options['places'] = 0;
			}
		} else {
			$decimal = 0;
			$options['places'] = 0;	
		}
		$default = $this->_currencyDefaults;

		if (isset($this->_currencies[$currency])) {
			$default = $this->_currencies[$currency];
		} elseif (is_string($currency)) {
			$options['before'] = $currency;
		}

		$options = array_merge($default, $options);

		$result = null;

		if ($number == 0 ) {
			if ($options['zero'] !== 0 ) {
				return $options['zero'];
			}
			$options['after'] = null;
		} elseif ($number < 1 && $number > -1 ) {
			if ($options['after'] !== false) {
				$multiply = intval('1' . str_pad('', $options['places'], '0'));
				$number = $number * $multiply;
				$options['before'] = null;
				$options['places'] = null;
			}
		} elseif (empty($options['before'])) {
			$options['before'] = null;
		} else {
			$options['after'] = null;
		}

		$abs = abs($number);
		$result = $this->format($abs, $options);

		if ($number < 0 ) {
			if ($options['negative'] == '()') {
				$result = '(' . $result .')';
			} else {
				$result = $options['negative'] . $result;
			}
		}
		return $result;
	}

/**
 * @see CakeNumber::addFormat()
 *
 * @param string $formatName The format name to be used in the future.
 * @param array $options The array of options for this format.
 * @return void
 * @see NumberHelper::currency()
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/number.html#NumberHelper::addFormat
 */
	public function addFormat($formatName, $options) {
		return $this->_engine->addFormat($formatName, $options);
	}

/**
 * @see CakeNumber::defaultCurrency()
 *
 * @param string $currency The currency to be used in the future.
 * @return void
 * @see NumberHelper::currency()
 */
	public function defaultCurrency($currency) {
		return $this->_engine->defaultCurrency($currency);
	}
	
	
	public function currencySymbol($currencyCode){
		if($currencyCode) {
			switch($currencyCode) {
				case 'GBP':
					$currencySymbol = '£';
					break;
				case 'USD':
					$currencySymbol = '$';
					break;
				case 'EUR':
					$currencySymbol = '€';
					break;
				default:
					$currencySymbol = $currencyCode;
					break;
			}
			return $currencySymbol;
		} else {
			return null;
		}
	}
}
