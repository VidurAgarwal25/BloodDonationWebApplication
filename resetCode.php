<?php
session_start();
$con = mysqli_connect('localhost', 'root', '1234');
mysqli_select_db($con, 'bdmainuserregistration');


if (isset($_POST['resetPass'])) {
    $_SESSION['in'] = "";
    $code = $_POST['otp'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $username = $_POST['user'];
    if (!empty($username) && !empty($password) && !empty($cpassword) && !empty($code)) {
        $check_code = "SELECT * FROM userinfo WHERE code = $code";
        $code_res = mysqli_query($con, $check_code);

        if (mysqli_num_rows($code_res) > 0) {

            $update_pass = "UPDATE userinfo SET password = '$password' WHERE username = '$username'";
            $run_query = mysqli_query($con, $update_pass);
            if ($run_query) {
                $_SESSION['in'] = "Your password has been changed. Now you can login with your new password.";
                header('Location: password-changed.php');
            } else {

                $_SESSION['in'] = "Failed to change password. Try again";
                header('Location: password-changed.php');
            }
        } else {

            $_SESSION['in'] =  "codes not matching";;
            header('Location: password-changed.php');
        }
    } else {

        $_SESSION['in'] = "empty fields";;
        header('Location: password-changed.php');
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

<head>

</head>
<form action="resetCode.php" method="post">
    <div class="container">
        <div class="form-container sign-up-container">
            <h1>Reset Password</h1>
            <?php
            if (isset($_SESSION['info'])) {
                ?>
            <h4 style="color: #A9A9A9;">
                Enter the OTP sent to <?php echo $_SESSION['email']; ?>
            </h4>
            <?php
            }
            ?>

            <input name="otp" type="text" placeholder="Enter OTP" />
            <input name="user" type="text" placeholder="Enter username" />
            <input name="password" type="password" placeholder="New Password" />
            <input name="cpassword" type="password" placeholder="Confirm Password" />

            <button name="resetPass">Reset Password</button>
        </div>
    </div>
</form>

</html>