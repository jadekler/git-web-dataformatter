<?php 
include_once "parser.php";

/**
 * This class parses information based on options provided by SAQA for 'Person Designations' classification
 */
class PersonDesignationParser extends Parser {
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
			"key" => null, 
			"padSize" => 20,
			"rules" => null
			),
		"Alternative_Id_Type" => array(
			"key" => "AUTOGEN", 
			"padSize" => 3,
			"rules" => "ALTIDAUTOGEN"
			),
		"Designation_Id" => array(
			"key" => "level_id", 
			"padSize" => 5,
			"rules" => null
			),
		"Designation_Registration_Number" => array(
			"key" => "id", 
			"padSize" => 20,
			"rules" => null
			), 
		"Designation_Prof_Body_Id" => array(
			"key" => "AUTOGEN", 
			"padSize" => 10,
			"rules" => "DPBIAUTOGEN"
			),
		"Designation_Start_Date" => array(
			"key" => "signupdate", 
			"padSize" => 8,
			"rules" => "DATEAUTOGEN"
			), 
		"Designation_End_Date" => array(
			"key" => "anniversarydate", 
			"padSize" => 8,
			"rules" => "DATEAUTOGEN"
			), 
		"Designation_Structure_Status_Id" => array(
			"key" => "designation_structure_status_id", 
			"padSize" => 10,
			"rules" => null
			), 
		"Prof_Body_Decision_Number" => array(
			"key" => null, 
			"padSize" => 20,
			"rules" => null
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
		"Date_Stamp" => array(
			"key" => "modified", 
			"padSize" => 8,
			"rules" => "DATEFORMAT"
			)
		);

	/**
	 * Sends format options to superclass
	 */
	public function __construct() {
		parent::__construct($this->formatOptions);
	}
}
?>