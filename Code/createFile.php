<?php
    if (isset($_POST["data"])){
       $file = fopen('files/file.txt',"w");
            $text = $_POST["data"];
		//echo $text;
            file_put_contents('files/file.txt' , $text);
		//echo $text;
            fclose($file);
        
	}
        header("Location:tenseSelect.php")
    
    ?>

