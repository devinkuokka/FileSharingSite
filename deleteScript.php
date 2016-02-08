<?php
	session_start();
	
	$files = $_POST['filesSelected'];
		
		if (isset ($_POST["DeletedFile"]) && count($files) > 0) {       //checks that a file is marked to delete
			$counter = 0;
			while (count($files) > $counter) {
				$target_dir = "/data/mod2_uploads/".$_SESSION['username']."/";
				$target_file = $target_dir.basename($files[$counter]);
				
				if (file_exists($target_file)) {        //checks file to delete exists and delets file
					unlink($target_file);
					echo "The file ".$files[$counter]." has been deleted. <br>";
				} else {
					echo "Sorry, there was an error deleting ".$files[$counter]." file.<br>";   //if an error deleting
				}
				$counter++;
			}
			header("Location: userFiles.php");  //returns to userFiles page
			exit;
		}
?>