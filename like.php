<?php
include("connect.php");
session_start();
if(isset($_SESSION["email"]))
{
	if(isset($_GET["song_id"]))
	{
		$song_id=$_GET["song_id"];
		$user_id=$_GET["user_id"];
		$likes=1;
		$cn=0;
		$update=0;
		$res=mysqli_query($con,"select user_id from likes where user_id=$user_id");
		if(mysqli_num_rows($res))
		{
			$result=mysqli_query($con,"delete from likes where user_id=$user_id");
			mysqli_query($con,"update song set likes=likes-1 where song_id='$song_id'");
			$ff=mysqli_query($con,"select user_id,song_id from unlikes where user_id=$user_id and song_id=$song_id");
			if(mysqli_num_rows($ff))
			{
				$eq=mysqli_query($con,"delete from unlikes where user_id=$user_id and song_id=$song_id");
				$et=mysqli_query($con,"update song set unlikes=unlikes-1 where song_id=$song_id");
				//if($eq&&$et)		
			}
			header("Location:welcome.php?song_id=$song_id");exit;		
		}	
		$rr=mysqli_query($con,"insert into likes (user_id,song_id,likes) values($user_id,$song_id,$likes)");
		$ff=mysqli_query($con,"update song set likes=likes+1 where song_id='$song_id'");
		$ee=mysqli_query($con,"select user_id,song_id from unlikes where user_id=$user_id and song_id=$song_id");
		if(mysqli_num_rows($ee))
		{
			$qq=mysqli_query($con,"delete from unlikes where user_id=$user_id and song_id=$song_id");
			$tt=mysqli_query($con,"update song set unlikes=unlikes-1 where song_id=$song_id");
			//if($qq&&$tt)
				
		}
		header("Location:welcome.php?song_id=$song_id");exit;		
	}
}
?>
