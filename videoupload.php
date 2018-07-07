	<?php
	include("connect.php");
	session_start();
	if(isset($_SESSION["email"]))
	{
		$user_id=$_GET["user_id"];
		$song_id=$_GET["song_id"];
		$cn=1;
		if(isset($_POST["submit"]))
		{
			$name="";		
			$result=mysqli_query($con,"select fname,lname from user where id='$user_id'");
			if(mysqli_num_rows($result))
			{
				$row=mysqli_fetch_assoc($result);
				$name=$row["fname"]." ".$row["lname"];
			}

			$video=$_FILES["vid"];
			$vname=$video["name"];
			$type=$video["type"];
			$tmp_loc=$video["tmp_name"];
			$dir="video/".$name;
			if(!is_dir($dir))
			{
				mkdir($dir);
			}
			if($dd=opendir($dir))
			{
				while($fil=readdir($dd))
				{
					if($fil==$vname)
					{
						$vname=$vname.$cn;					
					}
				}
				$cn++;
			}
			move_uploaded_file($tmp_loc,$dir."/".$vname);
			echo "<center>UPLOADED<br><a href='welcome.php?song_id=$song_id' >Back</a>";
		}
	?>
	<marquee behavior="alternate">You can upload upto 128 MB file Only</marquee>
	<br><br><br>
	<table border="1" align="center" width="700">
		<tr align="center">
			<td colspan="3">
				<form method="post" enctype="multipart/form-data">
					<h4>Select Your Video</h4>
					<input type="file" name="vid"><br><br>
					<input type="submit" name="submit" value="upload">
				</form>
			</td>
		</tr>
		<tr>
			<th colspan="3">Admin's Uploaded Song</th>
		</tr>
		<?php
			$dd=mysqli_query($con,"select song,likes,views,unlikes from song where uploaded_user_id='$user_id'");
			if(mysqli_num_rows($dd))
			{
				while($row=mysqli_fetch_assoc($dd))
				{?>
					<tr>
						<td width="400"><?php echo $row["song"];?></td>
						<td width="150"><?php echo $row["likes"];?></td>
						<td width="150"><?php echo $row["unlikes"];?></td>
						<td width="150"><?php echo $row["unlikes"];?></td>
					</tr>
			<?php
				}
			}

		?>			
		
		
	</table>
	</center>
	<?php
	}
	?>