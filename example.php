<?php

require $_SERVER["DOCUMENT_ROOT"] . "/php/autoload.php";
$CheckInModel = new CheckInModel;
$Table = new Table;

$inOpeningSession = array("event" => "Opening Session");
$checkedInToOpeningSession = array(
	"event" => "Opening Session",
	"isCheckedIn" => true,
);
$isASLAndCheckedInToOpeningSession = array(
	"event" => "Opening Session",
	"isCheckedIn" => true,
	"isSignLanguage" => true,
);

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>Model Example</title>
</head>

<body>
	<h1>API Examples</h1>
	<?php
		$api = array(
			array(
				"name" => "Get Events",
				"code" => "/api.php/checkin/getevents",
			),
			array(
				"name" => "Get Consultants",
				"code" => "/api.php/checkin/getconsultants",
			),
			array(
				"name" => "Count Consultants",
				"code" => "/api.php/checkin/countconsultants",
			),
			array(
				"name" => "Get Consultants in Opening Session",
				"code" => "/api.php/checkin/getconsultants?event=Opening%20Session",
			),
			array(
				"name" => "Count Consultants in Opening Session",
				"code" => "/api.php/checkin/countconsultants?event=Opening%20Session",
			),
			array(
				"name" => "Update Record",
				"code" => "/api.php/checkin/updaterecord?id=1&isCheckedIn=1",
			),
		);
		
		foreach ($api as $index => $endpoint) {
			$code = $endpoint["code"];
			$name = $endpoint["name"];
			$api[$index]["code"] = "<code>$code</code>";
			$api[$index]["name"] = "<a href=\"$code\" target=\"_blank\">$name</a>";
		}
	?>
	<?=$Table->getHTML($api)?>
	
	<h1>Events</h1>
	<pre>Events <?php print_r($CheckInModel->getEvents()); ?></pre>
	
	<hr>
	
	<h1>Total Consultants In Opening Session: <?=$CheckInModel->countConsultants($inOpeningSession)?></h1>
	<?=$Table->getHTML($CheckInModel->getConsultants($inOpeningSession))?>
	
	<hr>
	
	<h1>Checked In Consultants In Opening Session: <?=$CheckInModel->countConsultants($checkedInToOpeningSession)?></h1>
	<?=$Table->getHTML($CheckInModel->getConsultants($checkedInToOpeningSession))?>
	
	<hr>

	<h1>Checked In Sign Language Consultants In Opening Session: <?=$CheckInModel->countConsultants($isASLAndCheckedInToOpeningSession)?></h1>
	<?=$Table->getHTML($CheckInModel->getConsultants($isASLAndCheckedInToOpeningSession))?>
	
	<hr>
	
	<?php $CheckInModel->updateRecord(306, array(
		"isCheckedIn" => true,
	));?>
	Done.
</body>	
</html>
