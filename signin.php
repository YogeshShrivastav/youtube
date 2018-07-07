<?php

$message1="";
$message2="";
$_SESSION['count']=0;
include("connect.php");
if(isset($_POST["submit"]))
{
	$val=$_POST["submit"];
	if($val=="Sign-Up")
	{
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$email=$_POST["email"];
		$password=$_POST["password"];

												//form Validation//

		if(!empty($fname)&&!empty($lname))
		{
			if((preg_match("/^[a-zA-Z]*$/", $fname))&&(preg_match("/^[a-zA-Z]*$/", $lname)))
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					if(!empty($password))
					{
						$set=mysqli_query($con,"select * from user");
						if(mysqli_num_rows($set))
						{
							while($row=mysqli_fetch_assoc($set))
							{

						/*check if the record is already save in teh database the it gives am msg.*/

								if(($row["fname"]==$fname)&&($row["lname"]==$lname)&&($row["email"]==$email)) 	
								{
										
										?><script>alert("Reacord Already Exists");</script><?php		
								}
							}				
						}	

						$result=mysqli_query($con,"insert into user (fname,lname,email,password) values ('$fname','$lname','$email','$password')");
						if ($result)
						{
							?><script>alert("Record Submitted");</script><?php		
						}
						else
						{
							?><script>alert("Please Insert a valid Record");</script><?php		
						}
					}
					else
					{
						?><script>alert("Please fill All Fields");</script><?php
					}
				}
				else
				{
					?><script>alert("Invalid Email Address");</script><?php
				}					
			}
			else
			{
				?><script>alert("First or Last Name Must be String");</script><?php
			}
		}
		else
		{
			?><script>alert("Please fill All Fields");</script><?php
		}
	}
	if($val=="Log-In")
	{
		$username=$_POST["un"];
		$password=$_POST["up"];

		$ss=mysqli_query($con,"select email,password from user");
		while($row=mysqli_fetch_assoc($ss))
		{
			if(($row["email"]==$username)&&($row["password"]==$password))
			{
				$_SESSION["email"]=$username;				
				header("Location: index.php");exit;
			}				
		}
		?><script>alert("Incorrect username or password");</script><?php					
	}
}


?>

<table width="300" bgcolor="royalblue">
	<tr>
		<td>
			<table align="center">
				<form method="post">
				<tr>
					<th colspan="2">User Log-In</th>
				</tr>
				<tr height=30></tr>
				<tr>
					<td>Username : </td>
					<td><input type="text" name="un" placeholder="abcd@mail.com" style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr>
					<td>Password : </td>
					<td><input type="password" name="up" placeholder="Password"  style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr align="center">
					<td colspan="2"><input type="submit" name="submit" value="Log-In"><hr width="100"><hr width="240"></td>
				</tr>
				<tr height=20></tr>
				<tr>
					<td>
						<?php if(isset($message2)){echo $message2;} ?>
					</td>
				</tr>
				</form>
			</table>
		</td>				
	</tr>
	<tr>
		<td>			
			<table align="center">
				<form method="POST">
				<tr>
					<th colspan="2">Sign-Up</th>
				</tr>
				<tr height=30></tr>
				<tr>
					<td>Enter Name : </td>
					<td><input type="text" name="fname" placeholder="First Name" style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr>
					<td>Last Name : </td>
					<td><input type="text" name="lname" placeholder="Last Name" style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr>
					<td>Email ID : </td>
					<td><input type="text" name="email" placeholder="abcd@mail.com" style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr>
					<td>Password : </td>
					<td><input type="text" name="password" placeholder="Password" style="width: 170;"></td>
				</tr>
				<tr height=20></tr>
				<tr align="center">
					<td colspan="2"><input type="submit" name="submit" value="Sign-Up"><hr width="100"><hr width="240"></td>
				</tr>
				<tr height=20></tr>
				<tr align="center">
					<td colspan="2"><?php if(isset($message1)){echo $message1;}?></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>