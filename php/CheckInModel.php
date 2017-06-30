<?php

class CheckInModel {
	use MPDebuggable;
	use MPDatabase;
	
	private $table = "checkin";

	public function getEvents() {
		$table = $this->table;
		return $this->getDB()->query("SELECT event, count(*) AS count FROM $table GROUP BY event")
			->fetchAll();
	}
	
	public function getConsultants($criteria = array()) {
		$query[] = "SELECT * FROM " . $this->table;
		
		$where = array();
		$values = array();
		if (count($criteria) > 0) {
			foreach ($criteria as $field => $value) {
				$where[] = "$field = :$field";
				$values[":$field"] = $value;
			}
			$query[] = "WHERE " . implode(" AND ", $where);
		}
		
		$select = $this->getDB()->prepare(implode(" ", $query));
		$select->execute($values);
		
		return $select->fetchAll();
	}
	
	public function countConsultants($criteria = array()) {
		return count($this->getConsultants($criteria));
	}
	
	public function updateRecord($id = null, $criteria = null) {
		if ($id == null || $criteria == null) {
			error_log("CheckInModel->updateRecord() aborted: params incomplete.");
			return false;
		}
		
		$set = array();
		$values = array();
		foreach ($criteria as $field => $value) {
			$set[] = "$field = :$field";
			$values[":$field"] = $value;
		}
		
		$values[":id"] = $id;
		
		$query[] = "UPDATE " . $this->table;
		$query[] = "SET " . implode(", ", $set);
		$query[] = "WHERE id = :id";
		
		$insert = $this->getDB()->prepare(implode(" ", $query));
		return $insert->execute($values);
	}
}
