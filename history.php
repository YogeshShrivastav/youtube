<?php
session_start();
if(isset($_SESSION["email"]))
{
	include("connect.php");
	$user_id=$_GET["user_id"];
	$song_id=$_GET["song_id"];

	$result=mysqli_query($con,"select song,time,date from history where user_id='$user_id'");
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>History</title>
	</head>
	<body>
		<table border="1" align="center" width="500">
		<tr>
			<th colspan="3">HISTORY</th>
		</tr>
		<tr>
			<th width="300">Song</th>
			<th width="100">Date</th>
			<th width="100">Time</th>
		</tr>
<?php
if(mysqli_num_rows($result))
	{
		while($row=mysqli_fetch_assoc($result))
		{?>
			<tr>
				<td><?php echo $row["song"]?></td>
				<td><?php echo $row["date"]?></td>
				<td><?php echo $row["time"]?></td>
			</tr>
		<?php		
		}
	}?>
</table>
<br><br><center>
<a href="welcome.php?song_id=<?php echo$song_id; ?>">HOME</a>
</center>
</body>
</html>
<?php

}

?>