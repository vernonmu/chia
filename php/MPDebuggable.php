<?php

trait MPDebuggable {
	protected $debugEnabled = false;
	protected $debugOutput = array("error_log");
	
	public function debugIsEnabled() {
		return $this->debugEnabled;
	}
	
	public function addDebugOutput($which) {
		$this->debugOutput[] = $which;
	}
	
	public function enableDebug($message = false) {
		$this->debugEnabled = true;
		$this->trace($message);
	}
	
	public function disableDebug() {
		$this->debugEnabled = false;
	}
	
	private function convertToString($message) {
		if (is_array($message) || is_object($message)) {
			$message = print_r($message, true);
		}
		
		return $message;
	}
	
	public function trace($message, $output = "default") {
		// abort if not enabled or if the message is false
		if (!$this->debugEnabled || !isset($message) || !$message) {
			return false;
		}
		
		$message = get_class($this) . ": " . $this->convertToString($message);
		
		// apply default output if none is specified
		if ($output == "default") {
			$output = $this->debugOutput;
		} elseif (!is_array($output)) {
			$output = array($output);
		}
		
		if (in_array("error_log", $output)) {
			error_log($message);
		}
		if (in_array("echo", $output)) {
			echo("<pre>$message</pre>\n");
		}
		if (in_array("textarea", $output)) {
			echo "<textarea style=\"font-family: Menlo, Consolas, Monaco, monospace\" rows=\"30\" cols=\"120\">\n";
			echo htmlentities($message);
			echo "</textarea>\n";
		}
		if (in_array("console", $output)) {
			echo "<script>";
			echo 'console.log("' . str_replace('"', '\"', $message) . '");';
			echo "</script>\n";
		}
	}
}
