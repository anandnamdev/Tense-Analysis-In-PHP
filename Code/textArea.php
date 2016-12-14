<!DOCTYPE html>
<html>
<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Enter Text</title>

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

			
			<h1>Enter Your Text</h1>
			<textarea rows="20" cols="70" name="data" form="usrform" placeholder="Enter text here..." required ></textarea>
			

			<form action="createFile.php" id="usrform" method="post" enctype="multipart/form-data" class="form-horizontal">
				<input class="button" type="submit" name="submit" id="131" value="Go" class="btn btn-primary" >
    </form></div>

		</div>


		
	</body>

</html>
