<?php

class APICheckIn extends MPAPI {
	protected $modelClass = "CheckInModel";
	
	public function prepareParamsForUpdateRecord($params) {
		$id = $params["id"];
		unset($params["id"]);
		
		return array($id, $params);
	}
}
