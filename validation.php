<?php
session_start();

//establishing connection with local server
//second and third argument are username and password of server respectively
$con = mysqli_connect('localhost', 'root', '1234');

//selecting which database is to be used
mysqli_select_db($con, 'bdmainuserregistration');

//used to fetch the name entered by the user in the form
$name = $_POST['user'];

//used to fetch the password entered by the user in the form
$password = $_POST['password'];

//query for database to select all rows having the name same as entered by user
//this is done so that further we can check whether the username already exists in database or not
$s = " select * from userinfo where username= '$name' AND password='$password'";


//storing the query in result variable
$result = mysqli_query($con, $s);

//using mysqli_num_rows to see how many rows are there in result
//if the rows are 1 that means a username already exists by the same username 
$num = mysqli_num_rows($result);
if ($num == 1) {
    $_SESSION['username'] = $name;
    header('location:home.php');
} else {
    header('location:login.php');
}