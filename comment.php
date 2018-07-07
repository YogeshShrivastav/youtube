<?php
session_start();
if(isset($_SESSION["email"]))
{
	include("connect.php");
	if(isset($_POST["send"]))
	{
		$song_id=$_POST["song_id"];
		$user_id=$_POST["user_id"];
		$comment=$_POST["comment"];		

		$result=mysqli_query($con,"select fname,lname from user where id='$user_id' ");
		if(mysqli_num_rows($result))
		{
			$row=mysqli_fetch_assoc($result);
			$name=$row["fname"]." ".$row["lname"];
			$zz=mysqli_query($con,"insert into comment(song_id,user_id,name,comment) values($song_id,$user_id,'$name','$comment')");
			header("Location: welcome.php?song_id=$song_id");exit;
		}
		else
			echo "Rows are not there";
	}
}
?>