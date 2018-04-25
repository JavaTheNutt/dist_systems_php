<?php // login.php

// sanitizes the  username and password, encrypts the password, checks to see if there is a match.

include_once 'header.php';

echo "<div class='main'><h3>Please enter your details to log in</h3>";

$error = $user = $pass = "";



if (isset($_POST['user'])){

    $user = sanitizeString($_POST['user']);

    $pass = sanitizeString($_POST['pass']);



    if ($user == "" || $pass == ""){

        $error = "Not all fields were entered<br />";

    }

    else{

        $pass = md5('rt23@D'.$pass.'zva|32|'); //Encrypt the password with salting

		echo $pass;

        $query = "SELECT user,pass FROM members

            WHERE user='$user' AND pass='$pass'";



        if (mysqli_num_rows(queryMysql($query)) == 0) // No match in database

        {

            $error = "<span class='error'>Username/Password

                      invalid</span><br /><br />";

        }

        else  // match in database -> allow to login and re-direct to members.php

        {

            $_SESSION['user'] = $user;

            $_SESSION['pass'] = $pass;

            die("You are now logged in. Please <a href='members.php?view=$user'>" .

                "click here</a> to continue.<br /><br />");

        }

    }

}



echo <<<_END

<form method='post' action='login.php'>$error

<span class='fieldname'>Username</span><input type='text'

    maxlength='16' name='user' value='$user' /><br />

<span class='fieldname'>Password</span><input type='password'

    maxlength='16' name='pass' value='$pass' />

_END;

?>



<br />

<span class='fieldname'>&nbsp;</span>

<input type='submit' value='Login' />

</form><br /></div></body></html>