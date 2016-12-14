<!DOCTYPE html>
<html>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }

input[type=checkbox] {
    transform: scale(2);
    -ms-transform: scale(2);
    -webkit-transform: scale(2);
    padding: 100px;
}
</style>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Choose Tense</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/header-basic.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>


</head>

	<body>

		<header class="header-basic">

			<div class="header-limiter">

				<h1><a href="select.php"><span>Tense Analyzer System</span></a></h1>
			</div>

		</header>

			<div class="menu">

			<form action="logic.php" id="usrform" method="post" enctype="multipart/form-data" class="form-horizontal">
			<fieldset class="fieldset-auto-width" align="left">
    				<legend>Select Tense:</legend>
			&nbsp;&nbsp;&nbsp;<input type="checkbox" name="tense[]" id='c1' value="present"><font size="6">&nbsp;Present Tense</font></br>
			&nbsp;&nbsp;&nbsp;<input type="checkbox" name="tense[]" id='c2' value="past"><font size="6">&nbsp;Past Tense</br></font>
			&nbsp;&nbsp;&nbsp;<input type="checkbox" name="tense[]" id='c3' value="future"><font size="6">&nbsp;Future Tense</font></br>


				<input type="submit" name="submit" id="131" value="Go" onclick="if((!document.getElementById('c1').checked)&&(!document.getElementById('c2').checked)&&(!document.getElementById('c3').checked)){alert('You must choose atleast one option.');return false}" align="right"class="btn btn-primary">
			</fieldset>
    </form></div>

		</div>


		
	</body>

</html>
