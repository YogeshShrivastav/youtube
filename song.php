<?php
session_start();
include("connect.php");
if(isset($_SESSION["email"]))
{
	echo $_SESSION["email"];
	echo $_GET["song"];
	$song=$_GET["song"];
	$email=$_SESSION["email"];
	$user_id=0;

	$t=mysqli_query($con,"select id from user where email='$email'");
	if($row=mysqli_fetch_assoc($t))
	{
		$user_id=$row["id"];
	}

	$result=mysqli_query($con,"select song_id from song where song='$song'");
	if($row=mysqli_fetch_assoc($result))
	{
		$song_id=$row["song_id"];		
		$time=date("h:i:sa");
		$date=date("y-m-d");
		mysqli_query($con,"insert into history (song_id,user_id,song,time,date) values ($song_id,$user_id,'$song','$time','$date')");
		header("Location:welcome.php?song_id=".$song_id);exit;	
	}
	$dd=mysqli_query($con,"insert into song (song,uploaded_user_id,likes,views,unlikes) values ('$song','$user_id','','','')");
	header("Location: song.php?song=$song");		
}
else
{
	echo "Login Plz.......";
?>
<a href="index.php"> Home </a>
<?php
} ?>
</body>
	</html>