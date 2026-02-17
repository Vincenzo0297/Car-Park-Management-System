<?php
    // Start the session, this means that we can use the $_SESSION superglobal to store and access session variables
    session_start();

    if(isset($_POST['Logout'])) {

        // Unset all of the session variables, this will remove all data stored in the session
        session_unset();

        // Destroy the session, this will completely remove the session and its data from the server
        session_destroy();

        // Redirect the user to the login page after logging out
        header("Location: ../Login/Login.php");
        exit();
    }

?>