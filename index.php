<?php
// Let's get our SQL data!
include "lib/sql.php";
include "lib/personInformationParser.php";
include "lib/personDesignationParser.php";
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<body>
	<div class="container-fluid linkComparisonTool">
		<div class="row-fluid explanation">
			<h1>This is a tool <small>that pulls data and formats it for governmental use</small></h1>
			<span>
				This tool pulls data from a database, parses and formats it to government regulations, and exports it to a string
				for importation on the government's side. This tool is designed to comply with SAQA (South African Qualifications 
				Authority) database regulation. See guidelines at 
				<a href="wwww.saqa.org.za/nlrdpbinfo.asp">wwww.saqa.org.za/nlrdpbinfo.asp</a>
			</span>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<?php 
				// Output the Person Information data
				$parser = new PersonInformationParser();
				printrThis($parser->getFormatOptionsTitlesAsString());
				printrThis($parser->parseData(getMemberData("raw")));

				// Output the Person Designation data
				$parser = new PersonDesignationParser();
				printrThis($parser->getFormatOptionsTitlesAsString());
				printrThis($parser->parseData(getMemberData("raw")));
				?>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">

</script>