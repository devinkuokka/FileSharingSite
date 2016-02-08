<?php
    session_start();
    session_destroy();												//logs user out
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Logout</title>
        
        <style>
			body { background-color: #33CCCC; margin-top: 80px; }
			p { text-align: center; font-family: Helvetica, Arial, sans-serif; } 
		</style>
    </head>
    
    <body>
        <form action = "login.php" method = "get">
            <p>
                <br>
                You have been logged out.
				<br>
				<br>
				<input type = "submit" value = "Login"/>			<!--login button-->
            </p>
        </form>
    </body>
</html>