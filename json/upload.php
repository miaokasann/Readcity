<?php
	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 5242880))
	{
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else{

			if (file_exists("../images/" . $_FILES["file"]["name"])){
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else{
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "../images/".explode(".",$_FILES["file"]["name"])[0].time().'.'.explode(".",$_FILES["file"]["name"])[1]);
		      $file = explode(".",$_FILES["file"]["name"])[0].time().'.'.explode(".",$_FILES["file"]["name"])[1];
		      echo $file;
			}
    	}
    }
	else{
	  echo "Invalid file";
	}
?>