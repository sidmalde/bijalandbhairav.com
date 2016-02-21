<?php
App::uses('AppHelper', 'View/Helper');

class TimeHelper extends AppHelper {
	
	function yearsBetween($start, $end) {
	  $start_ts = strtotime($start);
	  $end_ts = strtotime($end);
	  $diff = $end_ts - $start_ts;
	  $diff = round(($diff / 86400) / 365);
		return $diff;
	}
	
	function daysBetween($start, $end, $negative = false) {
	  $start_ts = strtotime(substr($start,0,10).' 00:00:00');
	  $end_ts = strtotime(substr($end,0,10).' 00:00:00');
	  $diff = $end_ts - $start_ts;
	  $diff = round($diff / 86400);
	  if ($negative === false){
			$diff = abs($diff);
		}
		return $diff;
	}
	
/**
 * Converts a string representing the format for the function strftime and returns a
 * windows safe and i18n aware format.
 *
 * @param string $format Format with specifiers for strftime function.
 *    Accepts the special specifier %S which mimics th modifier S for date()
 * @param string UNIX timestamp
 * @return string windows safe and date() function compatible format for strftime
 * @access public
 */
 
	function convertSpecifiers($format, $time = null) {
		if (!$time) {
			$time = time();
		}
		$this->__time = $time;
		return preg_replace_callback('/\%(\w+)/', array($this, '__translateSpecifier'), $format);
	}

/**
 * Auxiliary function to translate a matched specifier element from a regular expresion into
 * a windows safe and i18n aware specifier
 *
 * @param array $specifier match from regular expression
 * @return string converted element
 * @access private
 */
	function __translateSpecifier($specifier) {
		switch ($specifier[1]) {
			case 'a':
				$abday = __c('abday', 5, true);
				if (is_array($abday)) {
					return $abday[date('w', $this->__time)];
				}
				break;
			case 'A':
				$day = __c('day',5,true);
				if (is_array($day)) {
					return $day[date('w', $this->__time)];
				}
				break;
			case 'c':
				$format = __c('d_t_fmt',5,true);
				if ($format != 'd_t_fmt') {
					return $this->convertSpecifiers($format, $this->__time);
				}
				break;
			case 'C':
				return sprintf("%02d", date('Y', $this->__time) / 100);
			case 'D':
				return '%m/%d/%y';
			case 'e':
				if (DS === '/') {
					return '%e';
				}
				$day = date('j', $this->__time);
				if ($day < 10) {
					$day = ' ' . $day;
				}
				return $day;
			case 'eS' :
				return date('jS', $this->__time);
			case 'b':
			case 'h':
				$months = __c('abmon', 5, true);
				if (is_array($months)) {
					return $months[date('n', $this->__time) -1];
				}
				return '%b';
			case 'B':
				$months = __c('mon',5,true);
				if (is_array($months)) {
					return $months[date('n', $this->__time) -1];
				}
				break;
			case 'n':
				return "\n";
			case 'p':
			case 'P':
				$default = array('am' => 0, 'pm' => 1);
				$meridiem = $default[date('a',$this->__time)];
				$format = __c('am_pm', 5, true);
				if (is_array($format)) {
					$meridiem = $format[$meridiem];
					return ($specifier[1] == 'P') ? strtolower($meridiem) : strtoupper($meridiem);
				}
				break;
			case 'r':
				$complete = __c('t_fmt_ampm', 5, true);
				if ($complete != 't_fmt_ampm') {
					return str_replace('%p',$this->__translateSpecifier(array('%p', 'p')),$complete);
				}
				break;
			case 'R':
				return date('H:i', $this->__time);
			case 't':
				return "\t";
			case 'T':
				return '%H:%M:%S';
			case 'u':
				return ($weekDay = date('w', $this->__time)) ? $weekDay : 7;
			case 'x':
				$format = __c('d_fmt', 5, true);
				if ($format != 'd_fmt') {
					return $this->convertSpecifiers($format, $this->__time);
				}
				break;
			case 'X':
				$format = __c('t_fmt',5,true);
				if ($format != 't_fmt') {
					return $this->convertSpecifiers($format, $this->__time);
				}
				break;
		}
		return $specifier[0];
	}

/**
 * Converts given time (in server's time zone) to user's local time, given his/her offset from GMT.
 *
 * @param string $serverTime UNIX timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string UNIX timestamp
 * @access public
 */
	function convert($serverTime, $userOffset) {
		$serverOffset = $this->serverOffset();
		$gmtTime = $serverTime - $serverOffset;
		$userTime = $gmtTime + $userOffset * (60*60);
		return $userTime;
	}

/**
 * Returns server's offset from GMT in seconds.
 *
 * @return int Offset
 * @access public
 */
	function serverOffset() {
		return date('Z', time());
	}

/**
 * Returns a UNIX timestamp, given either a UNIX timestamp or a valid strtotime() date string.
 *
 * @param string $dateString Datetime string
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Parsed timestamp
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function fromString($dateString, $userOffset = null) {
		if (empty($dateString)) {
			return false;
		}
		if (is_integer($dateString) || is_numeric($dateString)) {
			$date = intval($dateString);
		} else {
			$date = strtotime($dateString);
		}
		if ($userOffset !== null) {
			return $this->convert($date, $userOffset);
		}
		if ($date === -1) {
			return false;
		}
		return $date;
	}

/**
 * Returns a nicely formatted date string for given Datetime string.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function nice($dateString = null, $userOffset = null) {
		if ($dateString != null) {
			$date = $this->fromString($dateString, $userOffset);
		} else {
			$date = time();
		}
		$format = $this->convertSpecifiers('%e-%b-%Y '.__('at').' %H:%M', $date);
		return strftime($format, $date);
	}

/**
 * Returns a formatted date string: format d/m/Y.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @access public
 * @author Alexandre Leprêtre
 * @email alepretre@ssl247.co.uk
 * @created 2012-11-28
 */
	function niceDate($dateString = null, $userOffset = null) {
		return $this->format('d-M-Y', $dateString, false, $userOffset);
	}
	
	function niceDateTime($dateString = null, $userOffset = null) {
		return $this->format('d-M-Y', $dateString, false, $userOffset).' '.__('at').' '.$this->format('H:i', $dateString, false, $userOffset);
	}

/**
 * Returns a formatted descriptive date string for given datetime string.
 *
 * If the given date is today, the returned string could be "Today, 16:54".
 * If the given date was yesterday, the returned string could be "Yesterday, 16:54".
 * If $dateString's year is the current year, the returned string does not
 * include mention of the year.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Described, relative date string
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function niceShort($dateString = null, $userOffset = null) {
		$date = $dateString ? $this->fromString($dateString, $userOffset) : time();

		//$y = $this->isThisYear($date) ? '' : ' %Y';
		
		$y = '%Y';
		if ($this->isToday($dateString, $userOffset)) {
			$ret = sprintf(__('Today, %s'), strftime("%H:%M", $date));
		} elseif ($this->wasYesterday($dateString, $userOffset)) {
			$ret = sprintf(__('Yesterday, %s'), strftime("%H:%M", $date));
		} else {
			$format = $this->convertSpecifiers("%eS %b {$y} @ %H:%M", $date);
			$ret = strftime($format, $date);
		}

		return $ret;
	}
	
	function niceShortNoTime($dateString = null, $userOffset = null) {
		$result = $this->daysBetween($dateString, date('Y-m-d H:i:s'), true);
		if($result == 0) {
			return __('Today', true);
		} else if($result < 0) {
			if($result == -1) {
				return __('Tomorrow', true);
			} else {
				return sprintf(__('in %d days', true), abs($result));
			}
		} else {
			if($result == 1) {
				return __('Yesterday', true);
			} else {
				return sprintf(__('%d days ago', true), $result);
			}
		}
	}

/**
 * Returns a partial SQL string to search for all records between two dates.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param string $end Datetime string or Unix timestamp
 * @param string $fieldName Name of database field to compare with
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Partial SQL string.
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function daysAsSql($begin, $end, $fieldName, $userOffset = null) {
		$begin = $this->fromString($begin, $userOffset);
		$end = $this->fromString($end, $userOffset);
		$begin = date('Y-m-d', $begin) . ' 00:00:00';
		$end = date('Y-m-d', $end) . ' 23:59:59';

		return "($fieldName >= '$begin') AND ($fieldName <= '$end')";
	}

/**
 * Returns a partial SQL string to search for all records between two times
 * occurring on the same day.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param string $fieldName Name of database field to compare with
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Partial SQL string.
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function dayAsSql($dateString, $fieldName, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return $this->daysAsSql($dateString, $dateString, $fieldName);
	}

/**
 * Returns true if given datetime string is today.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is today
 * @access public
 */
	function isToday($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date('Y-m-d', $date) == date('Y-m-d', time());
	}

/**
 * Returns true if given datetime string is today.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is today
 * @access public
 */
	function isThatDay($dateString, $date) {
		if(date("Y-m-d", strtotime($date)) == date("Y-m-d", strtotime($dateString))){
			return true;
		}
		return false;
	}

/**
 * Returns true if given datetime string is within this week
 * @param string $dateString
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is within current week
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 */
	function isThisWeek($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date('W Y', $date) == date('W Y', time());
	}

/**
 * Returns true if given datetime string is within this month
 * @param string $dateString
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string is within current month
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 */
	function isThisMonth($dateString, $userOffset = null) {
		$date = $this->fromString($dateString);
		return date('m Y',$date) == date('m Y', time());
	}

/**
 * Returns true if given datetime string is within current year.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @return boolean True if datetime string is within current year
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 */
	function isThisYear($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return  date('Y', $date) == date('Y', time());
	}

/**
 * Returns true if given datetime string was yesterday.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string was yesterday
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 *
 */
	function wasYesterday($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date('Y-m-d', $date) == date('Y-m-d', strtotime('yesterday'));
	}

/**
 * Returns true if given datetime string is tomorrow.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return boolean True if datetime string was yesterday
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 */
	function isTomorrow($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date('Y-m-d', $date) == date('Y-m-d', strtotime('tomorrow'));
	}

/**
 * Returns the quarter
 *
 * @param string $dateString
 * @param boolean $range if true returns a range in Y-m-d format
 * @return boolean True if datetime string is within current week
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function toQuarter($dateString, $range = false) {
		$time = $this->fromString($dateString);
		$date = ceil(date('m', $time) / 3);

		if ($range === true) {
			$range = 'Y-m-d';
		}

		if ($range !== false) {
			$year = date('Y', $time);

			switch ($date) {
				case 1:
					$date = array($year.'-01-01', $year.'-03-31');
					break;
				case 2:
					$date = array($year.'-04-01', $year.'-06-30');
					break;
				case 3:
					$date = array($year.'-07-01', $year.'-09-30');
					break;
				case 4:
					$date = array($year.'-10-01', $year.'-12-31');
					break;
			}
		}
		return $date;
	}

/**
 * Returns a UNIX timestamp from a textual datetime description. Wrapper for PHP function strtotime().
 *
 * @param string $dateString Datetime string to be represented as a Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return integer Unix timestamp
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function toUnix($dateString, $userOffset = null) {
		return $this->fromString($dateString, $userOffset);
	}

/**
 * Returns a date formatted for Atom RSS feeds.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function toAtom($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date('Y-m-d\TH:i:s\Z', $date);
	}

/**
 * Formats date for RSS feeds
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function toRSS($dateString, $userOffset = null) {
		$date = $this->fromString($dateString, $userOffset);
		return date("r", $date);
	}

/**
 * Returns either a relative date or a formatted date depending
 * on the difference between the current time and given datetime.
 * $datetime should be in a <i>strtotime</i> - parsable format, like MySQL's datetime datatype.
 *
 * ### Options:
 *
 * - `format` => a fall back format if the relative time is longer than the duration specified by end
 * - `end` => The end of relative time telling
 * - `userOffset` => Users offset from GMT (in hours)
 *
 * Relative dates look something like this:
 *	3 weeks, 4 days ago
 *	15 seconds ago
 *
 * Default date formatting is d/m/yy e.g: on 18/2/09
 *
 * The returned string includes 'ago' or 'on' and assumes you'll properly add a word
 * like 'Posted ' before the function output.
 *
 * @param string $dateString Datetime string or Unix timestamp
 * @param array $options Default format if timestamp is used in $dateString
 * @return string Relative time string.
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function timeAgoInWords($dateTime, $options = array()) {
		$userOffset = null;
		if (is_array($options) && isset($options['userOffset'])) {
			$userOffset = $options['userOffset'];
		}
		if (isset($options['startTime'])) {
			$now = $options['startTime'];
		} else {
			$now = time();
		}
		if (!is_null($userOffset)) {
			$now = $this->convert(time(), $userOffset);
		}
		$inSeconds = $this->fromString($dateTime, $userOffset);
		$backwards = ($inSeconds > $now);

		$format = 'd M Y';
		$end = '+1 month';

		if (is_array($options)) {
			if (isset($options['format'])) {
				$format = $options['format'];
				unset($options['format']);
			}
			if (isset($options['end'])) {
				$end = $options['end'];
				unset($options['end']);
			}
		} else {
			$format = $options;
		}

		if ($backwards) {
			$futureTime = $inSeconds;
			$pastTime = $now;
		} else {
			$futureTime = $now;
			$pastTime = $inSeconds;
		}
		$diff = $futureTime - $pastTime;

		// If more than a week, then take into account the length of months
		if ($diff >= 604800) {
			$current = array();
			$date = array();

			list($future['H'], $future['i'], $future['s'], $future['d'], $future['m'], $future['Y']) = explode('/', date('H/i/s/d/m/Y', $futureTime));

			list($past['H'], $past['i'], $past['s'], $past['d'], $past['m'], $past['Y']) = explode('/', date('H/i/s/d/m/Y', $pastTime));
			$years = $months = $weeks = $days = $hours = $minutes = $seconds = 0;

			if ($future['Y'] == $past['Y'] && $future['m'] == $past['m']) {
				$months = 0;
				$years = 0;
			} else {
				if ($future['Y'] == $past['Y']) {
					$months = $future['m'] - $past['m'];
				} else {
					$years = $future['Y'] - $past['Y'];
					$months = $future['m'] + ((12 * $years) - $past['m']);

					if ($months >= 12) {
						$years = floor($months / 12);
						$months = $months - ($years * 12);
					}

					if ($future['m'] < $past['m'] && $future['Y'] - $past['Y'] == 1) {
						$years --;
					}
				}
			}
			if ($future['d'] >= $past['d']) {
				$days = $future['d'] - $past['d'];
			} else {
				$daysInPastMonth = date('t', $pastTime);
				$daysInFutureMonth = date('t', mktime(0, 0, 0, $future['m'] - 1, 1, $future['Y']));

				if (!$backwards) {
					$days = ($daysInPastMonth - $past['d']) + $future['d'];
				} else {
					$days = ($daysInFutureMonth - $past['d']) + $future['d'];
				}

				if ($future['m'] != $past['m']) {
					$months --;
				}
			}

			if ($months == 0 && $years >= 1 && $diff < ($years * 31536000)) {
				$months = 11;
				$years --;
			}

			if ($months >= 12) {
				$years = $years + 1;
				$months = $months - 12;
			}

			if ($days >= 7) {
				$weeks = floor($days / 7);
				$days = $days - ($weeks * 7);
			}
		} else {
			$years = $months = $weeks = 0;
			$days = floor($diff / 86400);

			$diff = $diff - ($days * 86400);

			$hours = floor($diff / 3600);
			$diff = $diff - ($hours * 3600);

			$minutes = floor($diff / 60);
			$diff = $diff - ($minutes * 60);
			$seconds = $diff;
		}
		$relativeDate = '';
		$diff = $futureTime - $pastTime;
		if ($years > 0) {
			// years and months and days
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d year', '%d years', $years), $years);
			$relativeDate .= $months > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d month', '%d months', $months), $months) : '';
			$relativeDate .= $weeks > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d week', '%d weeks', $weeks), $weeks) : '';
			$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d day', '%d days', $days), $days) : '';
		} elseif (intval ($months) > 0) {
			// months, weeks and days
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d month', '%d months', $months), $months);
			$relativeDate .= $weeks > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d week', '%d weeks', $weeks), $weeks) : '';
			$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d day', '%d days', $days), $days) : '';
		} elseif (intval ($weeks) > 0) {
			// weeks and days
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d week', '%d weeks', $weeks), $weeks);
			$relativeDate .= $days > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d day', '%d days', $days), $days) : '';
		} elseif (intval ($days) > 0) {
			// days and hours
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d day', '%d days', $days), $days);
			$relativeDate .= $hours > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d hour', '%d hours', $hours), $hours) : '';
		} elseif (intval ($hours) > 0) {
			// hours and minutes
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d hour', '%d hours', $hours), $hours);
			$relativeDate .= $minutes > 0 ? ($relativeDate ? ', ' : '') . sprintf(__n('%d minute', '%d minutes', $minutes), $minutes) : '';
		} elseif (intval ($minutes) > 0) {
			// minutes only
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d minute', '%d minutes', $minutes), $minutes);
		} else {
			// seconds only
			$relativeDate .= ($relativeDate ? ', ' : '') . sprintf(__n('%d second', '%d seconds', $seconds), $seconds);
		}
		if (!$backwards) {
			$relativeDate = sprintf(__('%s ago'), $relativeDate);
		}
		return $relativeDate;
	}

/**
 * Alias for timeAgoInWords
 *
 * @param mixed $dateTime Datetime string (strtotime-compatible) or Unix timestamp
 * @param mixed $options Default format string, if timestamp is used in $dateTime, or an array of options to be passed
 *   on to timeAgoInWords().
 * @return string Relative time string.
 * @see TimeHelper::timeAgoInWords
 * @access public
 * @deprecated This method alias will be removed in future versions.
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function relativeTime($dateTime, $options = array()) {
		return $this->timeAgoInWords($dateTime, $options);
	}

/**
 * Returns true if specified datetime was within the interval specified, else false.
 *
 * @param mixed $timeInterval the numeric value with space then time type.
 *    Example of valid types: 6 hours, 2 days, 1 minute.
 * @param mixed $dateString the datestring or unix timestamp to compare
 * @param int $userOffset User's offset from GMT (in hours)
 * @return bool
 * @access public
 * @link http://book.cakephp.org/view/1472/Testing-Time
 */
	function wasWithinLast($timeInterval, $dateString, $userOffset = null) {
		$tmp = str_replace(' ', '', $timeInterval);
		if (is_numeric($tmp)) {
			$timeInterval = $tmp . ' ' . __('days', true);
		}

		$date = $this->fromString($dateString, $userOffset);
		$interval = $this->fromString('-'.$timeInterval);

		if ($date >= $interval && $date <= time()) {
			return true;
		}

		return false;
	}

/**
 * Returns gmt, given either a UNIX timestamp or a valid strtotime() date string.
 *
 * @param string $dateString Datetime string
 * @return string Formatted date string
 * @access public
 * @link http://book.cakephp.org/view/1471/Formatting
 */
	function gmt($string = null) {
		if ($string != null) {
			$string = $this->fromString($string);
		} else {
			$string = time();
		}
		$string = $this->fromString($string);
		$hour = intval(date("G", $string));
		$minute = intval(date("i", $string));
		$second = intval(date("s", $string));
		$month = intval(date("n", $string));
		$day = intval(date("j", $string));
		$year = intval(date("Y", $string));

		return gmmktime($hour, $minute, $second, $month, $day, $year);
	}

/**
 * Returns a formatted date string, given either a UNIX timestamp or a valid strtotime() date string.
 * This function also accepts a time string and a format string as first and second parameters.
 * In that case this function behaves as a wrapper for TimeHelper::i18nFormat()
 *
 * @param string $format date format string (or a DateTime string)
 * @param string $dateString Datetime string (or a date format string)
 * @param boolean $invalid flag to ignore results of fromString == false
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted date string
 * @access public
 */
	function format($format, $date = null, $invalid = false, $userOffset = null) {
		$time = $this->fromString($date, $userOffset);
		$_time = $this->fromString($format, $userOffset);

		if (is_numeric($_time) && $time === false) {
			$format = $date;
			return $this->i18nFormat($_time, $format, $invalid, $userOffset);
		}
		if ($time === false && $invalid !== false) {
			return $invalid;
		}
		return date($format, $time);
	}

/**
 * Returns a formatted date string, given either a UNIX timestamp or a valid strtotime() date string.
 * It take in account the default date format for the current language if a LC_TIME file is used.
 *
 * @param string $dateString Datetime string
 * @param string $format strftime format string.
 * @param boolean $invalid flag to ignore results of fromString == false
 * @param int $userOffset User's offset from GMT (in hours)
 * @return string Formatted and translated date string @access public
 * @access public
 */
	function i18nFormat($date, $format = null, $invalid = false, $userOffset = null) {
		$date = $this->fromString($date, $userOffset);
		if ($date === false && $invalid !== false) {
			return $invalid;
		}
		if (empty($format)) {
			$format = '%x';
		}
		$format = $this->convertSpecifiers($format, $date);
		return strftime($format, $date);
	}
}
