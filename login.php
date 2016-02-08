<?php
	session_start();

	$uploadMsg = "";						
	$_SESSION['uploadMsg'] = $uploadMsg;		//creates session variable that will be the message returned after uploading a file
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
		
		<style>
			body { background-color: #33CCCC; margin-top: 80px; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; } 
		</style>
    </head>
	
    <body>
        <form action = "<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>" method = "get">
		<!--self-submitting form so that when incorrect username is entered, returns to same page-->
			
			<p>
				<br>
				Please Enter Your Username: <input type = "text" name = "username"/> 	<!--box to enter username-->
				<br>
				<br>
				<input type = "submit" value = "Login"/>								<!--login button-->
			</p>
		</form>
		
		<?php
			if (isset ($_GET['username'])) {					//checks that a username was entered
                $username = $_GET['username'];			
				$_SESSION['username'] = $username;				//creates and sets the session variable, username
				
				$file_path = "/data/mod2_uploads/";
				chdir("$file_path");
				
                $file = fopen("users.txt", "r");				//opens file (users.txt) that lists valid usernames 
                $lineNum = 1;
				
                while (!feof($file)) {							//checks if at end of file
                    $isUser = trim(fgets($file));				//if not, gets next valid username from file (& trims whitespace)
                    
					if ($isUser == $username) {					//compares inputted username to next valid username 
                         header("Location: userFiles.php");		//if inputted username matches, redirects to user's files
                         exit;
                    } else {
                        $lineNum++;								//else increments lineNum to next line in file
                    }
                }
				
				fclose($file);														//closes file
				
				echo "<p> Nice try, sucker!  Please enter a valid username. </p>";	//prints if inputted user name is invalid
            }
		?>	
    </body>
</html>