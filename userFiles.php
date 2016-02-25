<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Your Files</title>
		
		<link rel="stylesheet" type="text/css" href="userFilesStyle.css">
    </head>
	
    <body>
		<form action = "logout.php" method = "get">
			<p id = "logout">
				<input type = "submit" value = "Logout"/>
			</p>
		</form>
		
		<p id = "welcome">
			Welcome back <?php echo $_SESSION['username'];?>!
			<br>
			<br>
		</p>
	
		<?php
		// Lists uploaded files and allows you to open or delete them.
		
			if (isset ($_SESSION['username'])) {
				if ($dir = opendir("/data/mod2_uploads/".$_SESSION['username'])) {
		?>	
				<!--Uploading files using file browser-->
				<form enctype = "multipart/form-data" action = "uploadScript.php" method = "POST">
					<p id = "uplaod">
						<input type = "hidden" name = "MAX_FILE_SIZE" value = "20000000" />
						<label for = "uploadfile_input">Choose a file to upload:</label>
						<input type = "file" id = "uploadfile_input" name = "uploadedfile"  />
					</p>
					<p>
						<input type = "submit" name = "UploadFile" value = "Upload File" />
						<?php echo $_SESSION['uploadMsg']; ?>
						<br>
						<br>
					</p>
				</form>
				
				<!--Deleting files by marking check boxes and pressing delete button-->
				<form enctype = "multipart/form-data" action = "deleteScript.php" method = "POST">
					<p id = "fileBox">
		<?php 
						while (false !== ($fileName = readdir($dir))) {
							if ($fileName != "." && $fileName != "..") {			
								printf("
									<input type='checkbox' name='filesSelected[]' value='%s'/>
									<a href='openScript.php?name=%s'> %s </a> <br>",
								$fileName,
								$fileName,
								$fileName
							);
						}
					}
		?>
					</p>
					<p>
						<input type = "submit" name = "DeletedFile" value = "Delete" />
					</p>
				</form>
			
		<?php	
				closedir($dir);
				}
			}
		?>
		
    </body>
</html>