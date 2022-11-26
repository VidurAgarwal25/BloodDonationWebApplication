<html>

<head>
    <title>User Login and Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <div class="col-md-6">
            <h2>Registration</h2>
            <form action="registration.php" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Contact Number</label>
                    <input type="tel" name="contact" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" required>
                </div>
                <button class="btn btn-primary" type="submit">Register</button>
            </form>
        </div>

    </div>
</body>


</html>