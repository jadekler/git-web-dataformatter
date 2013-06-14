<?php
function getMemberData($outputType = "json", $outputSource = "return", $filter = "") {
	// Establish connection
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// Query server
	$result = mysql_query('
		SELECT * 
		FROM repssa_db.members members 
		LEFT JOIN repssa_db.statuses status 
		ON members.status_id = status.id
		LEFT JOIN repssa_db.titles titles
		ON members.title_id = titles.id
		'.$filter);
	$resultArr = array();

	// Collect data
	while ($row = mysql_fetch_assoc($result)) {
		$resultArr[] = $row;
	}

	// Close connection
	mysql_close($link);

	// Format data (json or raw)
	switch($outputType) {
		case "json":
			$resultArr = json_encode($resultArr);
			break;
		case "raw":
			break;
		default:
			break;
	}

	// Return data (echo or return)
	switch($outputSource) {
		case "return":
			return $resultArr;
			break;
		case "echo":
			echo $resultArr;
			break;
		default:
			break;
	}

	// Default return
	return null;
}

function printrThis($string) {
	echo "<pre>";print_r($string);echo "</pre>";
}
?>