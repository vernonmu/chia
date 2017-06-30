<?php

trait MPDatabase {
	protected $db = false;

	protected function getDB() {
		if (!$this->db) {
			$progress = array();
			$progress[] = "Setting config using hostname '" . gethostname() . "'";

			switch (gethostname()) {
				// local development
				case "cdlmac006.local": // Mark’s work iMac
					$progress[] = "Matched Mark’s work iMac";
					$dsn = "mysql:host=localhost;dbname=ambition2017;charset=utf8;port=3306";
					$user = "ambition2017dbu";
					$pass = "sneeze_25987";
				break;

				case "cdlmac004.local": // Vern's work iMac
					$progress[] = "Matched Vern's work iMac";
					$dsn = "mysql:host=localhost;dbname=ambition2017;charset=utf8;port=3306";
					$user = "ambition2017dbu";
					$pass = "sneeze_25987";
				break;

				// production
				// TODO change this to the actual connection strings for production
				default:
					$progress[] = "Did not match any entries: using production settings";
					$dsn = "mysql:host=localhost;dbname=mw;charset=utf8";
					$user = "mwerple";
					$pass = "mwaderpderpderp";
				break;
			}

			try {
				$this->db = new PDO(
					$dsn, $user, $pass,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);
			} catch (PDOException $e) {
				$progress[] = "Could not make a connection";
				$progress[] = $e->getMessage();
				error_log("MPDatabase Progress:\n\t" . implode("\n\t", $progress));
				exit("Database connection error. See log for details.");
			}

			try {
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$progress[] = "Could not set the connection attributes";
				$progress[] = $e->getMessage();
				error_log("MPDatabase Progress:\n\t" . implode("\n\t", $progress));
				exit("Database connection initialization error. See log for details.");
			}
		}

		return $this->db;
	}

	public function getLastInsertID() {
		return $this->getDB()->lastInsertId();
	}


	public function getFields($table, $output = "Field") {
		$select = $this->getDB()->prepare("SHOW COLUMNS FROM $table");
		$select->execute();
		$fields = $select->fetchAll();

		$output = array();
		foreach ($fields as $field) {
			$output[] = $field["Field"];
		}

		return $output;
	}
}
