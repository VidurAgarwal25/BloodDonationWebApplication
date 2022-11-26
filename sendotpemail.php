<?php
session_start();

$con = mysqli_connect('localhost', 'root', '1234');
mysqli_select_db($con, 'bdmainuserregistration');

$email = $_SESSION['email'];
$name = $_SESSION['otpuser'];
$fn = $_SESSION['fname'];
$contact = $_SESSION['contact'];
$password = $_SESSION['pass'];
$c = $_SESSION['code'];
if (isset($_POST['submitOtp'])) {
    $code = $_POST['otp'];
    if ($code == $c) {
        $reg = " insert into userinfo(name,username,contactnumber,password,code,email) values ('$fn','$name','$contact','$password','0','$email') ";
        mysqli_query($con, $reg);
        unset($_SESSION['email']);
        unset($_SESSION['otpuser']);
        unset($_SESSION['fname']);
        unset($_SESSION['contact']);
        unset($_SESSION['pass']);
        unset($_SESSION['code']);
        header("Location:login.php");
    } else {
        echo "Error Wrong Otp entered";
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
<form action="sendotpemail.php" method="post">
    <div class="container">
        <div class="form-container sign-up-container">
            <h1>Forgot Password</h1>
            <h4 style="color: #A9A9A9;">Enter the OTP sent to <?php print_r($_SESSION['email']); ?></h4>
            <input name="otp" type="text" placeholder="OTP" />


            <button name="submitOtp">Verify and Sign up</button>
        </div>
    </div>
</form>

</html>