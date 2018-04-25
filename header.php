<?php // header.php

session_start();

echo "<!DOCTYPE html>\n<html><head><script src='OSC.js'></script>";

include 'functions.php';  // connects to database and provides some useful functions



$userstr = ' (Guest)';



if (isset($_SESSION['user'])){ // will be set if someone is logged in

    $user     = $_SESSION['user']; //stores the users name

    $loggedin = TRUE;

    $userstr  = " ($user)";

}

else {

    $loggedin = FALSE;

}

//Display title The appname and username if looged in, guest otherwise.

echo "<title>$appname$userstr</title><link rel='stylesheet' " .

     "href='styles.css' type='text/css' />" .

     "</head><body><div class='appname'>$appname$userstr</div>";



if ($loggedin)

{

    echo "<br ><ul class='menu'>" .

         "<li><a href='members.php?view=$user'>Home</a></li>" .

         "<li><a href='members.php'>Members</a></li>" .

         "<li><a href='friends.php'>Friends</a></li>" .

         "<li><a href='messages.php'>Messages</a></li>" .

         "<li><a href='profile.php'>Edit Profile</a></li>" .

         "<li><a href='logout.php'>Log out</a></li></ul><br />";

}

else

{

    echo ("<br /><ul class='menu'>" .

         "<li><a href='index.php'>Home</a></li>" .

         "<li><a href='signup.php'>Sign up</a></li>" .

         "<li><a href='login.php'>Log in</a></li></ul><br />" .

         "<span class='info'>&#8658; You must be logged in to " .

         "view this page.</span><br /><br />");

}

?>