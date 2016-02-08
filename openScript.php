<?php
    session_start();
    
    $filename = $_GET['name'];
     
    //checks that the filename is in a valid format; if it's not, display an error and leave the script
    if( !preg_match('/^[\w _\.\-]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }
     
    //gets the username and make sure that it is alphanumeric with limited other characters.
    $username = $_SESSION['username'];
    
    if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo "Invalid username";
        exit;
    }
     
    $full_path = sprintf("/data/mod2_uploads/%s/%s", $username, $filename);
     
    //gets the MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($full_path);
    
     
    //sets the Content-Type header to the MIME type of the file, and displays the file
    header("Content-Type: ".$mime);
    header("Content-Transfer-Encoding: binary");
    
    $user_path = sprintf("/data/mod2_uploads/%s", $username);
    chdir("$user_path");

    $open_file = fopen($filename,'r') or die("Unable to open file!");
    
    echo fread($open_file, filesize("$filename"));
    fclose($open_file);
?>