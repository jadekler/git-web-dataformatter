<?php
/**
 * This class holds all the logic for parsing sets of data into readable format by SAQA's database, based on regulation
 * set at wwww.saqa.org.za/nlrdpbinfo.asp
 */
class Parser {
	/**
	 * The character we use to pad
	 * @var string
	 */
	public $padChar = " ";

	/**
	 * The format for all our dates
	 * @var string
	 */
	public $dateFormat = "Ymd";

	/**
	 * Format options which are sent from the subclasses. These options tell the parser which sets of information to 
	 * collect from the data that's passed into the parseData($people) function
	 * @var [type]
	 */
	public $formatOptions;

	/**
	 * The constant alternativeIdType given to the company by the gov
	 * @var integer
	 */
	public $alternativeIdType = 566;

	/**
	 * The default designation prof by id 
	 * @var integer
	 */
	public $designationProfBodyId = 820;

	/**
	 * A custom mapping for this particular company to translate its records (indexed alphabetically) to gov regulation 
	 * (which are not indexed alphabetically)
	 * @var array
	 */
	public $provinceCodeTable = array(2,4,7,5,9,8,3,6,1,'X','X');

	/**
	 * Accepts format options from the subclasses and initializes it
	 * @param array $formatOptions The format options which dictate the data the parser will collect
	 */
	public function __construct($formatOptions) {
		$this->formatOptions = $formatOptions;
	}

	/**
	 * Returns the formatOptions
	 * @return array Format options held by this super class
	 */
	public function getFormatOptions() {
		return $this->formatOptions;
	}

	/**
	 * DEBUG FUNCTION. Returns the title of all format options as a string which is sized exactly the same as the data
	 * in the corresponding column. This is useful as a way to spit out of a 'title' line whilst debugging code (to see 
	 * what title each column corresponds to)
	 * @return string A string of all the titles, sized identically to the data in that column
	 */
	public function getFormatOptionsTitlesAsString() {
		$optionTitlesString = "";
		foreach($this->formatOptions as $optionKey=>$option) {
			$optionTitlesString .= $this->formatSize($optionKey, $option['padSize'], $this->padChar);
		}
		return array($optionTitlesString);
	}

	/**
	 * The master function in charge of directing the data parsing. This function works in several steps:
	 * 1. Iterates over each person's data
	 * 2. Iterates over all the format options
	 * 3. Checks to see if the format option's 'key' exists in the person's data
	 * 	a. If it does
	 * 		i. Check to see if the format option has any rules for this piece of data
	 * 		ii. Resize the data according to the format option's padSize
	 * 	b. If it doesn't
	 * 		i. Simply pad the space according to the format option's padSize
	 * 4. Adds the person's formatted data string to $peopleStringArr
	 * @param  array  $people The array of data about people (which we fetch from SQL)
	 * @return array          An array of strings containing the data in $people that $formatOptions requested, formatted
	 *                        as per $ormatOptions
	 */
	public function parseData($people) {
		$peopleStringArr = array();
		foreach($people as $personIndex=>$person) {
			$personDataString = "";
			foreach($this->formatOptions as $field=>$option) {
				// Check if it's a key we have data for (is there a column in our SQL DB corresponding to our formatOption key?)
				if(isset($person[$option['key']]) || $option['key'] == 'AUTOGEN') {
					// WE HAVE THIS DATA - let's use it
					$datum = "";
					if(isset($person[$option['key']]))
						$datum = $person[$option['key']];

					// RULES - Let's check for and apply any rules this field has
					if(isset($option['rules'])) {
						switch($option['rules']) {
							case 'PROVINCE':
							$datum = $this->provinceFormat($datum, $this->provinceCodeTable);
							break;
							case 'ALTIDAUTOGEN':
							$datum = $this->alternativeIdType;
							break;
							case 'DPBIAUTOGEN':
							$datum = $this->designationProfBodyId;
							break;
							case 'DATEFORMAT':
							$datum = $this->dateFormat($datum, $this->dateFormat);
							break;
							case 'DATEAUTOGEN':
							$datum = $this->dateAutogen($this->dateFormat);
							break;
						}
					}

					// SIZE
					$personDataString .= $this->formatSize($datum, $option['padSize'], $this->padChar);
				} else {
					// WE DON'T HAVE THIS DATA - let's just pad the space
					$personDataString .= str_pad("", $option['padSize'], $this->padChar);
				}
			}

			// Add the person's formatted data string to the array containing all these strings
			$peopleStringArr[] = $personDataString;
		}
		return $peopleStringArr;
	}

	/**
	 * Format the size of a string (either pad it longer, or substring it shorter)
	 * @param  string $str     The string to pad
	 * @param  int 	  $padSize The size that $str needs to become
	 * @param  string $padChar The character we pad with
	 * @return string          A correctly sized string
	 */
	public function formatSize($str, $padSize, $padChar) {
		$dataString = "";

		// Is our string longer than it's allowed for in padSize?
		if(strlen($str) > $padSize) {
			// Yes, it is - let's trim it down to size
			$dataString .= substr($str, 0, $padSize);
		} else {
			// Not, it isn't - let's pad it up to size
			$dataString .= str_pad($str, $padSize, $padChar, STR_PAD_LEFT);
		}
		return $dataString;
	}

	/**
	 * Remaps a province code using the provinceCodeTable
	 * @param  int    $provinceCode      The code to remap
	 * @param  array  $provinceCodeTable The mapping table
	 * @return int                       The re-mapped code
	 */
	public function provinceFormat($provinceCode, $provinceCodeTable) {
		return $provinceCodeTable[$provinceCode-1];
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