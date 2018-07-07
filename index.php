
<html>
<head>
	<style>
		a:link
		{
			text-decoration: none;
			color: black;
		}
		a:visited
		{
			color: black;
		}
		a:hover
		{
			font-weight: bolder;
		}
	</style>
</head>
<body>
<?php
session_start();
?>

<table border="1" width="1200" align="center">
	<tr height="100" bgcolor="royalblue">
		<td colspan="3">
		<form method="get"><pre><span style="color:white;font-size: 70;font-weight: bolder;text-shadow: black 10px 10px 10px"> TUBe 	<input type="text" name="search" placeholder="Search" style="width: 300;height: 35;"> <input type="submit" name="nm" value="Search" style="width: 70;height: 35;"></span></form>	<?php if(isset($_SESSION["email"]))
													{
														echo $_SESSION["email"];?><a href="destroy.php"> [Log-out]</a><?php 
													}
													else
														{?><a  href="index.php?nm=login">Sign-Up & LogIn</a></pre>
												<?php } ?>
		</td>
	</tr>
	<tr height=	500">
		<td>		
			<?php
				if(is_dir("video/"))
				{
					if($d=opendir("video/"))
					{
						while($file=readdir($d))
						{
							if(!(($file=='.')||($file=='..')))
							{
								if($fd=opendir("video/".$file))
								{
									while($cn=readdir($fd))
									{
										if(!(($cn=='.')||($cn=='..')))
										{
											echo "<a href=song.php?song=".$cn."&mode=views>".$cn."</a><hr><hr><br>";
										}
									}
								}								
							}
						}
					}
				}?>
		</td>
		<?php
			if(isset($_GET["nm"]))
			{
				$val=$_GET["nm"];
				if($val=="Search")
				{
						
				}

				if(($val=="login"))
				{?>
		<td width="300">
			<?php include("signin.php"); ?>
		</td><?php
				}
			}?>
	</tr>
</table>



</body>
</html>
