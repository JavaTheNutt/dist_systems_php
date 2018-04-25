<?php //  functions.php



$db_name  = 'rndata';       // Modify these...

$username="root";   // ...variables according

$password = '!!IamRoot!!';   // ...to your installation

$appname = "Demo application"; // ...and preference

$host="ip-172-31-36-143"; // Host name  ec2-18-217-132-18.us-east-2.compute.amazonaws.com





$tbl_name="users"; // ****** Change this to your Table name

// Connect to server and select databse.

$con= mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect");







function createTable($name, $query)

{

    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");

    echo "Table '$name' created or already exists.<br />";

}



function queryMysql($query)

{

	global $con;

    $result = mysqli_query($con, $query) or die(mysqli_error());

	 return $result;

}



function destroySession()

{

    $_SESSION=array();



    if (session_id() != "" || isset($_COOKIE[session_name()]))

        setcookie(session_name(), '', time()-2592000, '/');



    session_destroy();

}



function sanitizeString($var)  

{

	//clean a variable of any potential threat or code injection

	global $con;

    $var = strip_tags($var);

    $var = htmlentities($var);

    $var = stripslashes($var);

    return mysqli_real_escape_string($con, $var);

	

}



function showProfile($user)

{

    if (file_exists("$user.jpg"))

        echo "<img src='$user.jpg' align='left' />";



    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");



    if (mysqli_num_rows($result))

    {

        $row = mysqli_fetch_row($result);

        echo stripslashes($row[1]) . "<br clear=left /><br />";

    }

}

?>

