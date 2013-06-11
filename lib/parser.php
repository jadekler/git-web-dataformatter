<?php
class Parser {
	public $formatOptions = array(
		"National_Id" => array(
			"key" => "idnumber", 
			"padSize" => 15,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Alternate_Id" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Alternative_Id_Type" => array(
			"key" => "", 
			"padSize" => 3,
			"padChar" => 0, 
			"rules" => null
			), 
		"Equity_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			),
		"National_Code" => array(
			"key" => null, 
			"padSize" => 3,
			"padChar" => 0, 
			"rules" => null
			), 
		"Home_Language_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			), 
		"Gender_Code" => array(
			"key" => "gender", 
			"padSize" => 1,
			"padChar" => 0, 
			"rules" => null
			),
		"Citizen_Resident_Status_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			), 
		"Socioeconomic_Status_Code" => array(
			"key" => null, 
			"padSize" => 2,
			"padChar" => 0, 
			"rules" => null
			), 
		"Disability_Status_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Last_Name" => array(
			"key" => "surname", 
			"padSize" => 45,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_First_Name" => array(
			"key" => "firstname", 
			"padSize" => 26,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Middle_Name" => array(
			"key" => null, 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Title" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Birth_Date" => array(
			"key" => "dob", 
			"padSize" => 8,
			"padChar" => 0, 
			"rules" => "DATEFORMAT"
			), 
		"Person_Home_Address_1" => array(
			"key" => null, 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Home_Address_2" => array(
			"key" => null, 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Home_Address_3" => array(
			"key" => null, 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Postal_Address_1" => array(
			"key" => "AUTOGEN", 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => "ADDRESS"
			),
		"Person_Postal_Address_2" => array(
			"key" => "AUTOGEN", 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => "ADDRESS"
			), 
		"Person_Postal_Address_3" => array(
			"key" => "AUTOGEN", 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => "ADDRESS"
			),
		"Person_Home_Addr_Postal_Code" => array(
			"key" => null, 
			"padSize" => 4,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Postal_Addr_Post_Code" => array(
			"key" => "postal_code", 
			"padSize" => 4,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Phone_Number" => array(
			"key" => "tel", 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Cell_Phone_Number" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Fax_Number" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Email_Address" => array(
			"key" => "email", 
			"padSize" => 50,
			"padChar" => 0, 
			"rules" => null
			), 
		"Province_Code" => array(
			"key" => "province_id", 
			"padSize" => 2,
			"padChar" => 0, 
			"rules" => null
			), 
		"Filler01" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			), 
		"Filler02" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			),
		"Person_Previous_Lastname" => array(
			"key" => null, 
			"padSize" => 45,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Previous_Alternate_Id" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			), 
		"Person_Previous_Alternative_Id_Type" => array(
			"key" => null, 
			"padSize" => 3,
			"padChar" => 0, 
			"rules" => null
			), 
		"Filler03" => array(
			"key" => null, 
			"padSize" => 20,
			"padChar" => 0, 
			"rules" => null
			), 
		"Filler04" => array(
			"key" => null, 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => null
			), 
		"Date_Stamp" => array(
			"key" => "AUTOGEN", 
			"padSize" => 10,
			"padChar" => 0, 
			"rules" => "DATEAUTOGEN"
			)
		);

public function parseData($members) {
	$memberStringArr = array();
	foreach($members as $memberIndex=>$member) {
		$memberDataString = "";
		foreach($this->formatOptions as $field=>$option) {
			// Check if it's a key we have data for (is there a column in our SQL DB corresponding to our formatOption key?)
			if(isset($member[$option['key']]) || $option['key'] == 'AUTOGEN') {
				// WE HAVE THIS DATA - let's use it
				$datum = $member[$option['key']];

				// RULES - Let's check for and apply any rules this field has
				if(isset($option['rules'])) {
					switch($option['rules']) {
						case 'ADDRESS':
							$datum = $this->addressFormat($member['postal_address'], $member['town'], $option['padSize']);
							break;
						case 'DATEFORMAT':
							$datum = $this->dateFormat($datum, 'dmY');
							break;
						case 'DATEAUTOGEN':
							$datum = $this->dateAutogen('dmY');
							break;
					}
				}

				// SIZE - Is our string longer than it's allowed for in formatOptions?
				if(strlen($datum) > $option['padSize']) {
					// Yes, it is - let's trim it down to size
					$memberDataString .= substr($datum, 0, $option['padSize']);
				} else {
					// Not, it isn't - let's pad it up to size
					$memberDataString .= str_pad($datum, $option['padSize'], $option['padChar'], STR_PAD_LEFT);
				}
			} else {
				// WE DON'T HAVE THIS DATA - let's just pad the space
				$memberDataString .= str_pad("", $option['padSize'], $option['padChar']);
			}
		}
		$memberStringArr[] = $memberDataString;
	}
	return $memberStringArr;
}

/**
 * This function formats a single line address and town string into a set of three strings
 * @param  [type] $addr [description]
 * @param  [type] $town [description]
 * @return [type]       [description]
 */
public function addressFormat(&$addr, &$town, $size) {
	$fullAddr = $addr." ".$town;
	$addr = $fullAddr;
	$town = "";

	if(strlen($fullAddr) > 0) {
		// There is more address to parse
		if(strlen($fullAddr) > $size-1) {
			// Address size is greater than the size restriction - use $size amount of characters and chop off start
			$addr = substr($fullAddr, $size-1, strlen($addr));
			$fullAddr = substr($fullAddr, 0, $size-1);
		} else {
			$addr = "";
		}
	} else {
		// Address is now empty
		return "";
	}

	return $fullAddr;
}

/**
 * Formats a date string
 * @param  string $rawDate 			The input raw date to be formatted
 * @param  string $outputFormat 	The format to convert the date to
 * @return string					The correctly formatted date
 */
public function dateFormat($rawDate, $outputFormat) {
	$date = new DateTime($rawDate);
	return $date->format($outputFormat);
}

/**
 * Returns the current date
 * @param  string $outputFormat 	The format to convert the date to
 * @return string 					The current date
 */
public function dateAutogen($outputFormat) {
	$date = new DateTime();
	return $date->format($outputFormat);
}
}
?>