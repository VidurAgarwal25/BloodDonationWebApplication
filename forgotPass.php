<?php
session_start();
$email = "";
$name = "";
$errors = array();
$con = mysqli_connect('localhost', 'root', '1234');

if (isset($_POST['submitPass'])) {
    $headers = 'From: covid.mailings@gmail.com' . "\r\n" .
        'MIME-Version 1.0' . "\r\n" .
        'Content-Type: text/html; charset=utf-8';

    mysqli_select_db($con, 'bdmainuserregistration');
    //getting email entered by user
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $name = $_POST['name'];
    //$check_email = "SELECT * FROM userinfo WHERE email='$email'";
    //$run_sql = mysqli_query($con, $check_email);

    $code = rand(999999, 111111);
    $insert_code = "UPDATE userinfo SET code = $code WHERE  username= '$name'";
    $run_query =  mysqli_query($con, $insert_code);
    if ($run_query) {

        if (mail($email, $code, "OTP for reseting password $code", $headers)) {
            $info = "We've sent a password reset otp to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
            header('location: resetCode.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while sending code!";
        }
    } else {
        $errors['db-error'] = "Something went wrong!";
    }
}

?>


<html>
<style>
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


button {
    border-radius: 20px;
    border: 1px solid #008f99;
    background-color: #008f99;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: bold;
    padding: 12px 45px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
    margin: 22px;
}

form {
    border-radius: 10px;
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 80px 50px;

    text-align: center;
}


input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
}

}
</style>

<head></head>
<form action="forgotPass.php" method="post">
    <div class="container">
        <div class="form-container sign-up-container">
            <h1>Forgot Password</h1>
            <h4 style="color: #A9A9A9;">Enter an email address where OTP can be sent</h4>
            <input name="email" type="text" placeholder="Email" />
            <input name="name" type="text" placeholder="Username" />

            <button name="submitPass">Send OTP</button>
        </div>
    </div>
</form>

</html>