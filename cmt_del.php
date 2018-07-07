<?php
session_start();
if(isset($_SESSION["email"]))
{
	include("connect.php");
	if(isset($_GET["song_id"]))
	{
		$song_id=$_GET["song_id"];
		$user_id=$_GET["user_id"];
		$comment=$_GET["comment"];
		$result=mysqli_query($con,"delete from comment where user_id='$user_id' and song_id='$song_id' and comment='$comment'");
		if($result)
			header("Location:welcome.php?song_id=$song_id");
		else
			echo "Nai Hua<br>";	
	}
}

?>