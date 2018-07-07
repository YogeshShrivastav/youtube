<?php
session_start();
include("connect.php");
if(isset($_SESSION["email"]))
{
	$song=$_GET["song"];

	$views=0;
	$cn=0;
	$song_id=0;
	$email=$_SESSION["email"];
	$result=mysqli_query($con,"select * from song where song='$song'");
	while($row=mysqli_fetch_assoc($result))
	{
		$song_id=$row["song_id"];		
		header("Location:welcome.php?song_id=".$song_id);		
		$cn=1;
	}
	if($cn==0)
	{
		$dd=mysqli_query($con,"insert into song (song,likes,views,unlikes) values ('$song','',$views,'')");
		header("Location:views.php?song=$song");
	}
}	
/*else
{
	if(isset($_SESSION["song"]))
	{
		$val=$_SESSION["song"];
		if(!($val==$song))
		{
			unset($_SESSION["obj"]);				
			header("Location:views.php?song=$song");exit;
		}
	}		
	header("Location: welcome.php?song=$song");
}*/