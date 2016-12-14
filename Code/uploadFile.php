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
<script>
function validate(elem){
    var alphaExp = /[\.txt]$/;

    if(elem.value.substr(elem.value.length - 3, 3)=="txt"){
	document.getElementById("131").disabled = false;
        return true;
    }else if(elem.files[0].size>1024)

	{
	alert("File size Exceeded");
	document.getElementById("131").disabled = true;
        elem.focus();
        return false;	
	}
	
	else{
        alert("Not a .txt file!!!");
	document.getElementById("131").disabled = true;
        elem.focus();
        return false;
    }
}

</script>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Upload File</title>

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

			
			<h1>Upload Your File</h1>

			

			<form action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal">
      
       
        		<input class="button" type="file" name="fileToUpload" id="file" onchange="validate(this)" size="40" class="btn btn-primary" required>&nbsp;&nbsp;&nbsp;<br><br><br><br>
       <input class="button" type="submit" name="submit" id="131" value="Upload" class="btn btn-primary">
    </form></div>

		</div>



		
	</body>

</html>
