<?php
session_start();
if(isset($_SESSION["email"]))
{
	include("connect.php");
	if(isset($_GET["song_id"]))
	{
		$s_id=$_GET["song_id"];
		$u_id=$_GET["user_id"];

		if(!isset($_SESSION["ui"]))
		{
			$_SESSION["ui"]=$u_id;
			$_SESSION["si"]=$s_id;		
		}
	}
	$user_id=$_SESSION["ui"];
	$song_id=$_SESSION["si"];

	$fname="";
	$lname="";
	$img="";

	$result=mysqli_query($con,"select fname,lname,profile_pic from user where id='$user_id'");
	if(mysqli_num_rows($result))
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$fname=$row["fname"];
			$lname=$row["lname"];
			$img=$row["profile_pic"];
		}
	}

	if(isset($_POST["submit"]))
	{	
		if($_POST["submit"]=="Upload")
		{
			$image=$_FILES["image"];
			$i_name=$image["name"];
			$i_type=$image["type"];
			if($i_type=="image/jpeg")
			{
				$dir="image/".$fname." ".$lname."/";
				if(is_dir($dir))
				{}
				else
				{
					mkdir($dir);
				}
				move_uploaded_file($image["tmp_name"],$dir.$i_name);
				$hj=mysqli_query($con,"update user set profile_pic='$i_name' where id='$user_id'");	
				if($hj)
					header("Location:upload.php");exit;
			}
			else
				echo "Object is not a Image type";
		}
		if($_POST["submit"]=="save")
		{
			$fn=$_POST["fn"];
			$ln=$_POST["ln"];
			mkdir("new dir");
			$da=mysqli_query($con,"update user set fname='$fn',lname='$ln' where id=$user_id");
			if($da)
			{
				unset($_SESSION["ui"]);
				unset($_SESSION["si"]);
				header("Location:welcome.php?song_id=$song_id");exit;
			}
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Upload</title>
	</head>
	<body>

	<center>
		<h2>Update Profile</h2>
	<br><br>
	<?php
	if(isset($result))
	{?>
	<table width="500">
		<tr align="center">
			<td>Profile <PICTURE></PICTURE></td>
			<td>
				<img src="<?php echo "image/".$fname.' '.$lname.'/'.$img;?>" height="100" width="100">
				<form method="post" enctype="multipart/form-data">
				<input type="file" name="image"><br>
				<br>
				<input type="submit" name="submit" value="Upload">	
				</form>
			</td>
			<form action="upload.php" method="post">
		</tr>
		<tr align="center">
			<td>First Name : </td>
			<td><input type="text" name="fn" value="<?php echo $fname;?>"></td>
		</tr>
		<tr height=20></tr>
		<tr align="center">
			<td>Last Name : </td>
			<td><input type="text" name="ln" value="<?php echo $lname;?>"></td>
		</tr>
		<tr height=20></tr>
		<tr align="center">
			<td colspan=2><input type="submit" name="submit" value="save"></td>
		</tr>
	</form>
	</table>
	</center>
	</body>
	</html>
	<?php
	}
}
?>
	<!-- if($hj)
				header("Location:welcome.php?song=$song"); -->