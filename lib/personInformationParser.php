<?php 
include_once "parser.php";

/**
 * This class parses information based on options provided by SAQA for the 'Person Information' classication
 */
class PersonInformationParser extends Parser {
	/**
	 * Essentially, this is the data that SAQA wants. Each piece of data (e.g. National_Id, Equity_Code, etc.) has 
	 * a couple of pieces of information relevant to the parser:
	 * 1. Key - this is the array key that the parser will look for in the $people data the parser has to fill this
	 *    piece of data. If it doesn't find this array key, it will simply leave it blank
	 * 1a NOTE - for data which need to be generated somehow by the program (specifically, via a rule), mark as
	 * 	  'AUTOGEN' (e.g. "key" => "AUTOGEN"). This will let it skip the 'Does this key exist in $people?' check
	 * 2. Pad Size - this is the size that this block of data must be when it is formatted as a string. If there is 
	 *    not enough data, it must be padded up, and if too much data, substring'd down
	 * 3. Rules - these are any additional rules to be applied to the data, such as DATEFORMAT, which formats a 
	 *    date per regulation. These additional rules must be written inside Parser (parser.php)
	 * @var array
	 */
	public $formatOptions = array(
		"National_Id" => array(
			"key" => "idnumber", 
			"padSize" => 15,
			"rules" => null
			),
		"Person_Alternate_Id" => array(
			"key" => "passport_number", 
			"padSize" => 20,
			"rules" => null
			),
		"Alternative_Id_Type" => array(
			"key" => "AUTOGEN", 
			"padSize" => 3,
			"rules" => "ALTIDAUTOGEN"
			), 
		"Equity_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			),
		"National_Code" => array(
			"key" => null, 
			"padSize" => 3,
			"rules" => null
			), 
		"Home_Language_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			), 
		"Gender_Code" => array(
			"key" => "gender", 
			"padSize" => 1,
			"rules" => null
			),
		"Citizen_Resident_Status_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			), 
		"Socioeconomic_Status_Code" => array(
			"key" => null, 
			"padSize" => 2,
			"rules" => null
			), 
		"Disability_Status_Code" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			),
		"Person_Last_Name" => array(
			"key" => "surname", 
			"padSize" => 45,
			"rules" => null
			), 
		"Person_First_Name" => array(
			"key" => "firstname", 
			"padSize" => 26,
			"rules" => null
			), 
		"Person_Middle_Name" => array(
			"key" => null, 
			"padSize" => 50,
			"rules" => null
			), 
		"Person_Title" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			), 
		"Person_Birth_Date" => array(
			"key" => "dob", 
			"padSize" => 8,
			"rules" => "DATEFORMAT"
			), 
		"Person_Home_Address_1" => array(
			"key" => null, 
			"padSize" => 50,
			"rules" => null
			),
		"Person_Home_Address_2" => array(
			"key" => null, 
			"padSize" => 50,
			"rules" => null
			), 
		"Person_Home_Address_3" => array(
			"key" => null, 
			"padSize" => 50,
			"rules" => null
			), 
		"Person_Postal_Address_1" => array(
			"key" => "town", 
			"padSize" => 50,
			"rules" => null
			),
		"Person_Postal_Address_2" => array(
			"key" => "AUTOGEN", 
			"padSize" => 50,
			"rules" => null
			), 
		"Person_Postal_Address_3" => array(
			"key" => "AUTOGEN", 
			"padSize" => 50,
			"rules" => null
			),
		"Person_Home_Addr_Postal_Code" => array(
			"key" => null, 
			"padSize" => 4,
			"rules" => null
			), 
		"Person_Postal_Addr_Post_Code" => array(
			"key" => "postal_code", 
			"padSize" => 4,
			"rules" => null
			),
		"Person_Phone_Number" => array(
			"key" => "tel", 
			"padSize" => 20,
			"rules" => null
			), 
		"Person_Cell_Phone_Number" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			), 
		"Person_Fax_Number" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			),
		"Person_Email_Address" => array(
			"key" => "email", 
			"padSize" => 50,
			"rules" => null
			), 
		"Province_Code" => array(
			"key" => "province_id", 
			"padSize" => 2,
			"rules" => "PROVINCE"
			), 
		"Filler01" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			), 
		"Filler02" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			),
		"Person_Previous_Lastname" => array(
			"key" => null, 
			"padSize" => 45,
			"rules" => null
			), 
		"Person_Previous_Alternate_Id" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			), 
		"Person_Previous_Alternative_Id_Type" => array(
			"key" => null, 
			"padSize" => 3,
			"rules" => null
			), 
		"Filler03" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			), 
		"Filler04" => array(
			"key" => null, 
			"padSize" => 10,
			"rules" => null
			), 
		"Date_Stamp" => array(
			"key" => "AUTOGEN", 
			"padSize" => 8,
			"rules" => "DATEAUTOGEN"
			)
		);

	public function __construct() {
		parent::__construct($this->formatOptions);
	}
}
?>