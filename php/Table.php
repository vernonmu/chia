<?php

class Table {
	public function getHTML($data) {
		if (!$data || count($data) == 0) {
			error_log("No data passed to Table->getHTML()");
			return "";
		}
		
		$theHTML = "";
		
		$theHTML .= "<table>\n";
		$theHTML .= "<tr>\n";
		foreach ($data[0] as $name => $value) {
			$theHTML .= "<th>$name</th>\n";
		}
		$theHTML .= "</tr>\n";
		foreach ($data as $item) {
			$theHTML .= "<tr>\n";
			foreach ($item as $value) {
				$theHTML .= "<td>$value</td>\n";
			}
			$theHTML .= "</tr>\n";
		}
		$theHTML .= "</table>\n";
		
		return $theHTML;
	}
}
