<?php

	session_start();
	    
	if (isset ($_POST["UploadFile"]) && isset ($_FILES["uploadedfile"]["name"])) {
		if( !preg_match('/^[\w _\.\-]+$/', $filename) ){        //checks for valid file name
            echo "Invalid filename";
        } else {  
            $target_dir = "/data/mod2_uploads/".$_SESSION['username']."/";          //sets target directory
            $target_file = $target_dir. basename($_FILES["uploadedfile"]["name"]);
            $uploadOK = 1;
		
            if (file_exists($target_file)) {            //checks if file already exists
                $_SESSION['uploadMsg'] = "Sorry, file already exists.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_file)) {    //uploads file
                    $_SESSION['uploadMsg'] = "Your file has been uploaded.";
                } else {
                    $_SESSION['uploadMsg'] = "Sorry, there was an error uploading your file.";  //if there is an error uplaoding
                }
            }
        }    
            header("Location: userFiles.php");
            exit;
    }
?>