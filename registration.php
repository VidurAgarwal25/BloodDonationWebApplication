<?php
session_start();
//the header is used to tell the system that after user registers
//where he/she should be redirected

//establishin connection with local server
//second and third argument are username and password of server respectively
$con = mysqli_connect('localhost', 'root', '1234');

//selecting which database is to be used
mysqli_select_db($con, 'bdmainuserregistration');

//used to fetch the name entered by the user in the form
$name = $_POST['user'];

//used to fetch the name of the user
$fn = $_POST['fname'];

//used to fetch the contact number
$contact = $_POST['contact'];

//used to fetch the password entered by the user in the form
$password = $_POST['regpassword'];

//email of the user
$email = $_POST['email'];

//query for database to select all rows having the name same as entered by user
//this is done so that further we can check whether the username already exists in database or not
$s = " select * from userinfo where username= '$name'";

//storing the query in result variable
$result = mysqli_query($con, $s);

//using mysqli_num_rows to see how many rows are there in result
//if the rows are ore than 0 that means a username already exists by the same username 
$num = mysqli_num_rows($result);
if ($num == 1) {
    echo "username already taken";
} else {

    // $reg = " insert into userinfo(name,username,contactnumber,password,code,email) values ('$fn','$name','$contact','$password','0','$email') ";
    // mysqli_query($con, $reg);
    $email = "";
    $name = "";
    $errors = array();
    $headers = 'From: covid.mailings@gmail.com' . "\r\n" .
        'MIME-Version 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8';

    //getting email entered by user


    //$check_email = "SELECT * FROM userinfo WHERE email='$email'";
    //$run_sql = mysqli_query($con, $check_email);

    $code = rand(999999, 111111);
    $insert_code = "UPDATE userinfo SET code = $code WHERE  username= '$name'";
    $run_query =  mysqli_query($con, $insert_code);
    if ($run_query) {

        if (mail($email, $code, "OTP for verification $code", $headers)) {
            $_SESSION['email'] = $email;
            $_SESSION['otpuser'] = $name;
            $_SESSION['fname'] = $fn;
            $_SESSION['contact'] = $contact;
            $_SESSION['pass'] = $password;

            header('location: sendotpmail.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while sending code!";
        }
    } else {
        $errors['db-error'] = "Something went wrong!";
    }
}