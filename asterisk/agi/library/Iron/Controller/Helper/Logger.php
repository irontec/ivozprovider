<?php
class Iron_Controller_Helper_Logger extends Zend_Controller_Action_Helper_Abstract
{
	private $_syslog = null;

	public function __construct()
	{
		$writer = new Zend_Log_Writer_Syslog(array(
				'application' => 'ivozlog',
				'facility' => LOG_LOCAL6,
		));

		$this->_syslog = new Zend_Log($writer);
	}

	public function direct(){

		## Only UID and Text
		if (func_num_args() == 2){
			$trace = debug_backtrace();
			if (isset($trace[2])){
				$file   = $trace[2]['file'];
				$line   = $trace[2]['line'];
				$level  = LOG_DEBUG;
				$this->doLog(func_get_arg(0), $file, $line, $level, func_get_arg(1));
			}else{
				Throw new Exception("Zend logger not loaded properly");
			}
		}else if (func_num_args() == 5){
			$this->doLog(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3), func_get_arg(4));
		}else{
			Throw new Exception("Zend logger not loaded properly");
		}
	}

	public function doLog($uid, $file, $line, $level, $str = '')
	{
		if (is_null($this->_syslog)) {

			Throw new Exception("Zend logger not loaded properly");
		}

		//Parse message
		$fileSegments = explode("/", $file);
		$filename = $fileSegments[count($fileSegments)-1];

		if (empty($uid)) {

			$logmsg = "[$filename][$line] $str";

		} else {

			$logmsg = "[$uid][$filename][$line] $str";
		}

		$priority = $this->getPriority($level);
		$this->_syslog->log($logmsg, $priority);
	}

	private function getPriority ($level)
	{
		//Default priority : DEBUG
		$priority = 7;

		switch (strtoupper($level)) {

			case 'LOG_EMERG':
				$priority = 0;  // Emergency: system is unusable
				break;

			case 'LOG_ALERT':
				$priority = 1;  // Alert: action must be taken immediately
				break;

			case 'LOG_CRIT':
				$priority = 2;  // Critical: critical conditions
				break;

			case 'LOG_ERR':
				$priority = 3;  // Error: error conditions
				break;

			case 'LOG_WARN':
				$priority = 4;  // Warning: warning conditions
				break;

			case 'LOG_NOTICE':
				$priority = 5;  // Notice: normal but significant condition
				break;

			case 'LOG_INFO':
				$priority = 6;  // Informational: informational messages
				break;
		}

		return $priority;
	}
}

