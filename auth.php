<?php
include('db_connection.php');
session_start();

function logout() {
    //clearing data stored in the session
    session_unset();
    //Destroying of current session. and loging  user out.
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
