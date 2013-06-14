<?php
include_once "sql.php";
include_once "personInformationParser.php";
include_once "personDesignationParser.php";

// Checks for POST data from AJAX
if(isset($_POST['fn'])) {
	switch($_POST['fn']) {
		case 'SAQA 35': 
		exportSAQA35();
		break;
		case 'SAQA 36':
		exportSAQA36();
		break;
		default:
		break;
	}

	// Close the tab
	echo "<script>window.close();</script>";
}

/**
 * Exports a SAQA File 35 document
 * @return void
 */
function exportSAQA35() {
	$parser = new PersonInformationParser();
	$content = collectSAQAData($parser->parseData(getMemberData("raw")));
	outputFile("35", $content);
}

/**
 * Exports a SAQA File 36 document
 * @return void
 */
function exportSAQA36() {
	$parser = new PersonDesignationParser();
	$content = collectSAQAData($parser->parseData(getMemberData("raw")));
	outputFile("36", $content);
}

/**
 * Outputs generates and downloads (on user side) the SAQA records file
 * @param  string $fileType The file type (e.g. file 35 is Person Information)
 * @param  string $content  The string containing all user records, correctly formatted per SAQA regulation
 * @return void
 */
function outputFile($fileType, $content) {
	$fileName = generateFileName($fileType);

	!$handle = fopen($fileName, 'w');
	fwrite($handle, $content);
	fclose($handle);

	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Length: ". filesize("$fileName").";");
	header("Content-Disposition: attachment; filename=$fileName");
	header("Content-Type: application/octet-stream; "); 
	header("Content-Transfer-Encoding: binary");

	// Download the file
	readfile($fileName);

	// Delete the file (on the server side)
	unlink($fileName);
}

/**
 * Generates the file name based on SAQA regulation
 * @param  string $fileType The file type (e.g. file 35 is Person Information)
 * @return string           The correctly formatted file name
 */
function generateFileName($fileType) {
	$fileName = "";
	$repssaID = "XXXX";
	$date = new DateTime();
	$format = "dat";

	$fileName = $repssaID.$fileType.$date->format('ymd').".".$format;

	return $fileName;
}

/**
 * Takes an array of SAQA-regulation-formatted user records and converts to string format
 * @param  array  $saqaArr Array of SAQA-regulation-formatted user records
 * @return string          Long string of user records
 */
function collectSAQAData($saqaArr) {
	$collector = "";
	foreach($saqaArr as $item) {
		$collector .= $item."\n";
	}
	return $collector;
}
?>