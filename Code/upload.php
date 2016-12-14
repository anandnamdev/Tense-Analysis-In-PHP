<?php
	
	if(isset($_POST['submit']))
	{
		$myext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
			if($myext != "txt")
			{	
				echo "No file Selected";
				echo("<btn><a href='uploadFile.php'><br>Back</a><btn>");
			}
			else
			{
				
					if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "files/file.txt"))
					{
						header("Location: tenseSelect.php");
					}
					else{ 
						echo "Upload Failed!";
					}
			}
	}
	
?>
