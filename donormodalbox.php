<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thank You</title>
    <link rel="stylesheet" href="stylemodal.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="center">

        <div class="content">
            <div class="header">
                <h2>Thankyou!</h2>
            </div>
            <label for="click"><img class="tick" src="images/tenor1.gif" /></label>
            <p><b>You are AWESOME.</b><i class="fas fa-heart"></i></p>
            <form action="home.php">
                <button>Home</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>