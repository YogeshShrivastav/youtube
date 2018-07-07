<?php
if(isset($_SESSION["email"]))
{
	if(isset($_GET["nm"]))
	{
		$dd=isset($_GET["nm"];
		if($dd=="go")
		{
			echo "string"; "message sent";
			header("index.php");
		}
	}
}

?>