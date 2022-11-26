<?php
session_start();
//the header is used to tell the system that after user registers
//where he/she should be redirected

//establishin connection with local server
//second and third argument are username and password of server respectively
$con = mysqli_connect('localhost', 'root', '1234');

//selecting which database is to be used
mysqli_select_db($con, 'bdmainuserregistration');

if (isset($_POST['submitotp'])) {
    //used to fetch the name entered by the user in the form
    $name = $_POST['user'];

    //used to fetch the name of the user
    $fn = $_POST['fname'];

    //used to fetch the contact number
    $contact = $_POST['contact'];

    //used to fetch the password entered by the user in the form
    $password = $_POST['regpassword'];

    //email of the user


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

        $errors = array();
        $headers = 'From: covid.mailings@gmail.com' . "\r\n" .
            'MIME-Version 1.0' . "\r\n" .
            'Content-Type: text/html; charset=utf-8';

        //getting email entered by user
        $email = mysqli_real_escape_string($con, $_POST['email']);


        //$check_email = "SELECT * FROM userinfo WHERE email='$email'";
        //$run_sql = mysqli_query($con, $check_email);

        $code = rand(999999, 111111);


        if (mail($email, $code, "OTP for verification $code", $headers)) {
            $_SESSION['email'] = $email;
            $_SESSION['otpuser'] = $name;
            $_SESSION['fname'] = $fn;
            $_SESSION['contact'] = $contact;
            $_SESSION['pass'] = $password;
            $_SESSION['code'] = $code;

            header('location: sendotpemail.php');
            exit();
        } else {
            echo $email;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
    box-sizing: border-box;
}

body {
    background: #f6f5f7;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-image: url("https://images.unsplash.com/photo-1444044205806-38f3ed106c10?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mjc5fHxibHVyJTIwYmFja2dyb3VuZHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60");
    background-repeat: no-repeat;
    background-size: cover;
    font-family: 'Montserrat', sans-serif;
    height: 100vh;
    margin: -20px 0 50px;
}

h1 {
    font-weight: bold;
}

h2 {
    text-align: center;
    color: revert;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: 0.5px;
    margin: 20px 0 30px;
}

span {
    font-size: 12px;
}

a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}

button {
    border-radius: 20px;
    border: 1px solid #8f1b42;
    background-color: #e32056;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
    margin: 22px;
}

button:active {
    transform: scale(0.95);
}

button:focus {
    outline: none;
}

button.ghost {
    background-color: transparent;
    box-shadow: 5px 5px 2px #202020,
        -2px -2px 3px #8f1b42;
}

form {
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 80px 50px;
    height: 100%;
    text-align: center;
}

input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
}

.container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
        0 10px 10px rgba(0, 0, 0, 0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.right-panel-active .sign-in-container {
    transform: translateX(100%);
}

.sign-up-container {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: show 0.6s;
}

@keyframes show {

    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }

    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
}

.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

.overlay {
    background: #000000;
    background: -webkit-linear-gradient(to right, #771536, #c70f43);
    background: linear-gradient(to right, #771536, #c70f43);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 0;
    color: #FFFFFF;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.overlay-left {
    transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
    transform: translateX(0);
}

.overlay-right {
    right: 0;
    transform: translateX(0);
}

.container.right-panel-active .overlay-right {
    transform: translateX(20%);
}

.social-container {
    margin: 20px 0;
}

.social-container a {
    border: 1px solid #DDDDDD;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    height: 40px;
    width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}
</style>

<head>


</head>

<body>
    <h2>Stay Safe, Stay Strong</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="login.php" method="post">
                <h1 style="font-size: 23px;">Create Account</h1>

                <input name="fname" type="text" placeholder="Name" required />
                <input name="user" type="text" placeholder="User Name" required />
                <input type="text" name="email" placeholder="Email (An OTP will be sent here)" id="" required>

                <input name="contact" type="tel" placeholder='Contact Number' pattern="(0/91)?[7-9][0-9]{9}">
                <input name="regpassword" type="password" placeholder="Password" required />
                <input type="password" placeholder="Confirm Password" required />
                <button name="submitotp">Send OTP</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="validation.php" method="post">
                <h1>Sign in</h1>
                <input name="user" type="text" placeholder="Username" required />
                <input name="password" type="password" placeholder="Password" required />
                <a href="forgotPass.php">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Already have an account?</h1>
                    <p>Please login</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>New User? Register</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
    </script>
</body>

</html>