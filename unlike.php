<?php
session_start();
if(isset($_SESSION["email"]))
{
	include("connect.php");
	if(isset($_GET["user_id"]))
	{
		$cn=0;
		$user_id=$_GET["user_id"];
		$song_id=$_GET["song_id"];
		$unlikes=1;
		$result=mysqli_query($con,"select user_id from unlikes where user_id=$user_id");
		if(mysqli_num_rows($result))
		{

			$tt=mysqli_query($con,"delete from unlikes where user_id=$user_id");
			$dd=mysqli_query($con,"update song set unlikes=unlikes-1 where song_id=$song_id");
			if($tt&&$dd)
				header("Location:welcome.php?song_id=$song_id");exit;
		}	

		$rr=mysqli_query($con,"select user_id,song_id from likes where user_id=$user_id and song_id=$song_id");
		if(mysqli_num_rows($rr))
		{
			$rr=mysqli_query($con,"insert into unlikes(user_id,song_id,unlikes) values ($user_id,$song_id,$unlikes)");
			$uu=mysqli_query($con,"update song set unlikes=unlikes+1 where song_id='$song_id'");	
			$tr=mysqli_query($con,"delete from likes where song_id=$song_id and user_id=$user_id");
			$rt=mysqli_query($con,"update song set likes=likes-1 where song_id=$song_id");
			if($tr&&$rt)
				header("Location:welcome.php?song_id=$song_id");exit;
		}
		else
		{
			$wr=mysqli_query($con,"insert into unlikes(user_id,song_id,unlikes) values ($user_id,$song_id,$unlikes)");
			$rw=mysqli_query($con,"update song set unlikes=unlikes+1 where song_id='$song_id'");		
			if($wr&&$rw)
			header("Location:welcome.php?song_id=$song_id");exit;
		}	
	}
}
?>
