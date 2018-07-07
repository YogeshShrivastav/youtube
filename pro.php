<?php
session_start();
if(isset($_SESSION["email"]))
{
	if($_POST["submit"]=="Upload")
	{
		$image=$_FILES["image"];
		$i_name=$image["name"];
		$i_type=$image["type"];
		if($i_type=="image/jpeg")
		{
			move_uploaded_file($image["tmp_name"],"image/".$i_name);
			$hj=mysqli_query($con,"update user set profile_pic='$i_name' where id='$user_id'");	
			if($hj)
				header("Location:upload.php");exit;
		}
		else
			echo "Object is not a Image type";
	}
}
?>