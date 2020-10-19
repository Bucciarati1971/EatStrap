<?php
require_once('dbConnect.php');

// $account = $_POST['myAccount'];
// $password = $_POST['myPassword'];
// $refer = $_POST['refer'];


    if (($_POST['myAccount'] == "") || ($_POST['myPassword']) == "") {
        header('Location: eHome.php?refer='. urlencode($_POST['refer']));
    } else {
    
    // $query = mysqli_query($link,"SELECT * FROM e_user WHERE E_Name =
        // '{$_POST["myAccount"]}' AND  E_password = '{$_POST["myPassword"]}'");
        $link = mysqli_connect($severName, $userName, $password);
        mysqli_select_db($link, $databaseName);


        $query = "SELECT E_ID, MD5(UNIX_TIMESTAMP() + E_ID + RAND(UNIX_TIMESTAMP()))
        guid FROM e_user WHERE E_Name = '{$_POST['myAccount']}' AND E_password = '{$_POST['myPassword']}'";
        

        $result = mysqli_query($link, $query) ;
    
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_row($result);
            // Update the user record
            $query = "UPDATE e_user SET guid = '$row[1]' WHERE E_ID = $row[0]";
            
            mysqli_query($link, $query) or die('Error in query');
        
            // Set the cookie and redirect
            // setcookie( string name [, string value [, int expire [, string path
            // [, string domain [, bool secure]]]]])
            // Setting cookie expire date, 6 hours from now
            $cookieexpiry = (time() + 21600);
            setcookie("session_id", $row[1], $cookieexpiry);

            if (empty($_POST['refer']) || !($_POST['refer'])) {
                $refer = 'portal.php';
            }

            header('Location: '. ($_POST['refer']));
        } else {
            // Not authenticated
            header('Location: login.php?refer='. urlencode($refer));
        }
    }
