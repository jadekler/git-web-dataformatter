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
				<form name="export" action="lib/exportSAQAData.php" method="POST">
					<input type="submit" name="fn" value="SAQA 35">
				</form>

				<form name="export" action="lib/exportSAQAData.php" method="POST">
					<input type="submit" name="fn" value="SAQA 36">
				</form>
			</div>
		</div>
	</div>
</body>
</html>