<?php

class MPAPI {
	use MPDebuggable;
	
	protected $model = false;
	protected $output = "json";
	
	static function run() {
		$params  = explode("/", trim($_SERVER["PATH_INFO"], "/"));
		$apiName = "API" . array_shift($params);
		$method  = array_shift($params);
		
		$api = new $apiName;
		$api->$method();
	}
	
	public function __call($method, $params) {
		$model = $this->model();
		if (!method_exists($model, $method)) {
			error_log("Couldn't find method named $method in model $this->modelClass.");
			return false;
		}
		
		return $this->output(
			call_user_func_array(
				array($model, $method),
				$this->prepareParamsFor($method, $_GET)
			)
		);
	}

	private function model() {
		if (!$this->model) {
			$this->model = new $this->modelClass;
		}
		
		return $this->model;
	}
	
	private function output($data) {
		switch ($this->output) {
			case "json":
				header("Content-Type: application/json");
				echo json_encode($data, JSON_PRETTY_PRINT);
				return "JSON output complete.";
			break;
		}
	}
	
	protected function prepareParamsFor($method, $params) {
		$prepareMethod = "prepareParamsFor$method";
		if (method_exists($this, $prepareMethod)) {
			return $this->$prepareMethod($params);
		}
		
		return array($params);
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}
}
