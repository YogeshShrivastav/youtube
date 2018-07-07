	<?php
	session_start();

	include("connect.php");
	$song="";
	$user="";
	$views=0;
	$count=0;
	$likes=0;
	$unlikes=0;
	$pic="";
	$name="";
	$user_id=0;
	$song_id=0;
	if(isset($_SESSION["email"]))
	{
		$user=$_SESSION["email"];
		$song_id=$_GET["song_id"];

		$rr=mysqli_query($con,"select * from user where email='$user'");
		$r=mysqli_fetch_assoc($rr);
		if($r)
		{
			$user_id=$r["id"];
			$name=$r["fname"]." ".$r["lname"];
			$pic=$r["profile_pic"];
		}
		$rt=mysqli_query($con,"select * from song where song_id=$song_id");
		$rw=mysqli_fetch_assoc($rt);
			$song=$rw["song"];			 	
		
		$result=mysqli_query($con,"select * from song where song_id='$song_id'");
		$row=mysqli_fetch_assoc($result);
			$likes=$row["likes"];
			$views=$row["views"];
			$unlikes=$row["unlikes"];	
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>welcome</title>
			<style>
				a:link
				{
					text-decoration: none;
					color:black;
				}
				a:visited
				{
					color: black				
				}
				a:hover
				{
					font-weight: bolder;
					font-size: 15px;
				}
			</style>
		</head>
												<!-- TITLE and search option -->
		<body>
			<form method="post">
			<div style="background-color: royalblue; height: 50px ">
				<pre>  <span style="font-size: 40px; font-weight: bolder;color:white;text-shadow: black 10px 10px 10px;">TUBe	</span><input type="text" name="search" placeholder="Seacrh" style="width: 250px"> <input type="submit" name="nm" value="Seacrh"></form>				<span style="text-shadow: black 7px 7px 5px;color:white;"><img src="<?php if(isset($pic)){echo 'image/'.$name.'/'.$pic;}?>" width=30 height=30> <a href="upload.php?song_id=<?php echo $song_id; ?>&user_id=<?php echo $user_id; ?>"><?php echo strtoupper($name) ?></a> <a href="destroy.php">[Log-Out]</a>	<a href="videoupload.php?user_id=<?php echo $user_id;?>&song_id=<?php echo $song_id;?>">Upload</a>|<a href="history.php?user_id=<?php echo $user_id; ?>&song_id=<?php echo $song_id; ?>">History</a></pre>
			</div>
													<!-- Video Player -->

			<table border=1 width="1333">
				<tr height="700">
					<td>
						<table border="1" width="800" height="350">
							<tr>
								<td>
									<video height="450" width="800" autoplay="autoplay" controls>
									<?php
										if(is_dir("video/"))
										{
											if($open=opendir("video/"))
											{
												while($fl=readdir($open))
												{
													if(!(($fl=='.')||($fl=='..')))
														echo $fl;?>
										
										<source src="video/<?php echo $fl.'/'.$song;?>"  type="video/mp4">
										<?php

												}
											}
										}
										?>	
								</td>
							</tr>						
						</table>
												<!-- //showing likes unlike  -->

						<pre> <a href="like.php?song_id=<?php echo $song_id;?>&user_id=<?php echo $user_id?>"><?php
						$zz=mysqli_query($con,"select user_id from likes where user_id=$user_id");
						if(mysqli_num_rows($zz))
							echo "Liked";
						else
							echo "Like";
						?></a> : <?php echo $likes;?> 		<a href="unlike.php?song_id=<?php echo $song_id;?>&user_id=<?php echo $user_id;?>"><?php
						$ra=mysqli_query($con,"select unlikes from unlikes where user_id=$user_id and song_id=$song_id");
						if(mysqli_num_rows($ra))
							echo "Unliked";
						else
							echo "Unlike";
						?></a> : <?php echo $unlikes;?> 					Views : <?php echo $views; ?></pre>
						<hr color="lightgray">
						<center><?php echo $song; ?></center>
						<hr color="lightgray">
						<?php 
														//Showing Comment///

						$ff=mysqli_query($con,"select comment,name from comment where song_id=$song_id");
						while($row=mysqli_fetch_assoc($ff))
						{
							$rr=$row["comment"];
							echo " @ ".$row['name']."<br>";
							echo " => ".$rr."<br>";
							echo "<pre> <a href='welcome.php?song_id=$song_id&nm=edit&val=$rr'> Edit</a>	 <a href='cmt_del.php?song_id=$song_id&user_id=$user_id&comment=$rr'>Delete</a></pre>";						
						}
						?>
						<hr color="lightgray">
						<pre> <?php echo "(".$user_id." ".$name.")" ?><br><br><form action="comment.php" method="post"><input type="text" name="comment"<?php 
						if(isset($_GET['nm']))
						{
							$co=$_GET["val"];
							if($_GET["nm"]=="edit")
							{
								$gh=mysqli_query($con,"select comment from comment where song_id='$song_id' and user_id='$user_id' and comment='$co'");
								
								mysqli_query($con,"delete from comment where user_id='$user_id' and song_id='$song_id' and comment='$co'");								
								if(mysqli_num_rows($gh))
								{
									while($row=mysqli_fetch_assoc($gh))
									{
										echo "value='".$row['comment']."'";
									}
								}
							}						
						}
						?>
						placeholder="Comment here" style="width:300px; height: 50px;"><input type="hidden" name="song_id" value="<?php echo $song_id ?>" ><input type="hidden" name="user_id" value="<?php echo $user_id ?>" > <input type="submit" name="send" value="Post">
							</form>
						</pre>
					</td>
													<!-- Sowing Viseos form the folder -->

					<td width="500">	
						<?php
						if(isset($_POST["nm"]))
						{
							//you are to import seacrh.php file here;
						}
						else
						{
							if(is_dir("video/"))
							{
								if($dd=opendir("video/"))
								{
									while($file=readdir($dd))
									{
										if(!(($file=='.')||($file=='..')))
										{
											if($new=opendir("video/".$file))
											{
												while($ff=readdir($new))
												{
													if(!(($ff=='.')||($ff=='..')))
													{
														echo "<a href=song.php?song=$ff>".$ff." - $file</a><hr color='lightgray'>";
													}													
												}
											}
										}									
										
									}
								}
							}
						}	
		
						?>
					</td>					
				</tr>	
			</table>

	<?php
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