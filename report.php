<?php
session_start();

$con = mysqli_connect('localhost', 'root', '1234');
mysqli_select_db($con, 'bdentrydatabase');

if (isset($_POST['userid'])) {
    $r = $_POST['userid'];

    $querys = "update donortable set numreports = numreports+1 where iden=$r";

    mysqli_query($con, $querys);

    header("location:getalldonorslist.php");
}
//unset($_SESSION['userid']);
//header("Location:getalldonorslist.php");