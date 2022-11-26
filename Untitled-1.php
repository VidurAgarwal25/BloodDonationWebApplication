<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    //file properties
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_error = $file['error'];

    //work out file extension
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('txt', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf');

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {

            $file_name_new = uniqid('', true) . '.' . $file_ext;
            $file_dest = 'uploadedFiles/' . $file_name_new;

            if (move_uploaded_file($file_tmp, $file_dest))
                echo "file uploaded";
        }
    }
}
?>
<html>

<head>

</head>

<body>
    <form action="Untitled-1.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="">
        <input type="submit" value="upload" name="" id="">
    </form>

</body>

</html>