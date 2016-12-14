<?php
//	echo "Otherwise redirect to album.php <br>";

echo  $_POST["username"];
if( $_POST["username"] =="eval@eval.com" && $_POST["password"] =="eval") {
      echo "Welcome ". $_POST['username']. "<br />";
      echo "You are ". $_POST['password']. " years old.";
    header("Location: select.php");
   }
else {

echo"</br><h1>Login Error!!!</h1></br></br></br>";
echo'<a href="index.html"><h3>Go Back</h3></a>';
}
?>
