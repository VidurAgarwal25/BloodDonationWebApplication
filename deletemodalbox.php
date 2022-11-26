<?php
session_start();
$con = mysqli_connect('localhost', 'root', '1234');

mysqli_select_db($con, 'bdmainuserregistration');

if (isset($_POST['deletebtn'])) {
    $usern = $_POST['user'];
    $passw = $_POST['pass'];
    $query = "DELETE from userinfo where username= '$usern' AND password='$passw'";
    if (mysqli_query($con, $query)) {
        header("Location:logout.php");
    } else {
        echo "Error";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thank You</title>
    <link rel="stylesheet" href="deletemodalstyle.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="center">
        <div class="content">
            <div class="header">
                <h2>SURE?</h2>
            </div>

            <p><b>Are you sure you want to delete your account?</b></p>
            <form action="deletemodalbox.php" method="post">
                <input class="user" type="text" name="user" placeholder="Enter username" required>
                <input class="passw" type="password" name="pass" placeholder="Enter password" required>
                <button type="submit" class="del" name="deletebtn">Delete</button>

            </form>
            <a href="home.php"> <button class="home">Home</button></a>

        </div>
    </div>
    </div>
</body>

</html>