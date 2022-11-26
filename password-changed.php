<?php
session_start();

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

    <script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
    </script>
</head>
<form action="login.php" method="post">
    <div class="container">
        <div class="form-container sign-up-container">
            Hey
            <?php
            if (isset($_SESSION['in'])) {
                ?>
            <h4>
                <?php echo $_SESSION['in']; ?>
            </h4>
            <?php
            }
            ?>
            <button type="submit" name="login">Login Now</button>
        </div>
    </div>
</form>

</html>