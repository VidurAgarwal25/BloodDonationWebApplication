<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:home.php");
}
$con = mysqli_connect('localhost', 'root', '1234');

mysqli_select_db($con, 'bdentrydatabase');


$bg = $_SESSION['bloodgroup'];
$patientname = $_SESSION['name'];
$state = $_SESSION['statelocation'];
$city = $_SESSION['city'];

$query = "SELECT * FROM donortable";
//$name = "SELECT name FROM donortable WHERE bloodgroup='$bg' and stateloc='$state' and city='$city'";
$run_query = mysqli_query($con, $query);

/* <?php if (isset($_POST[$n])) {
                                        $querys = "update donortable set numreports = numreports+1 where iden=$r";
                                        mysqli_query($con, $querys);
                                        // print_r($r);
                                        print_r($row['numreports']);
                                    }

                                    ?> */

// if (mysqli_num_rows($run_query) > 0) {
// echo "<h1>LIST OF DONORS</h1>";
// echo "<table>";
    // echo "<tr>";
        // echo "<th>Name</th>";
        // echo "<th>Contact</th>";
        // echo "<th>Age</th>";
        // echo "<th>Blood Group</th>";
        // echo "<th>City</th>";
        // echo "<th>State</th>";
        // echo "</tr>";
    // while ($row = mysqli_fetch_array($run_query)) {
    // echo "<tr>";
        // echo "<td>" . $row['donorname'] . "</td>";
        // echo "<td>" . $row['contact'] . "</td>";
        // echo "<td>" . $row['age'] . "</td>";
        // echo "<td>" . $row['bloodgroup'] . "</td>";
        // echo "<td>" . $row['city'] . "</td>";
        // echo "<td>" . $row['stateloc'] . "</td>";
        // echo "</tr>";
    // }
    // echo "</table>";
// // Free result set
// mysqli_free_result($run_query);
// } else {
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
    <style>
    .nodonorbox {
        align-items: center;
        padding: 25px;
        background: -webkit-linear-gradient(to right, #1e3535, #0c8cac);
        background: linear-gradient(to right, #1e3535, #0c8cac);
        border-radius: 15px;
        color: white;
    }

    body {
        background-color: rgb(245, 237, 235);
        align-items: center;
    }

    h1 {
        text-align: center;
    }

    h2 {
        text-align: center;
        font-size: 35px;
        color: #000;
    }

    table {
        border-spacing: 0;
        min-width: 60%;
        max-width: 100%;
        margin: auto;
    }

    th {
        background-color: #d92054;
        text-align: center;
        padding: 9px;
        color: #fff;
        box-shadow: 2px 2px 11px #fff;
    }

    td {
        text-align: center;
        padding: 9px;
        box-shadow: 5px 5px 10px #888;
    }

    tr:nth-child(even) {
        background-color: rgb(253, 237, 235);
        ;
    }

    tr:nth-child(odd) {
        background-color: #fff;
    }

    input {
        height: auto;
        width: auto;
        border-radius: 20px;
        margin-top: 20px;
        border: 1px solid #d92054;
        background-color: #d92054;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 10px 35px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    .homebtn {
        margin-left: 46%;
    }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>

</head>

<body>

    <script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
    </script>

    <?php if (mysqli_num_rows($run_query) > 0) { ?>
    <h1>LIST OF DONORS</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Age</th>
            <th>Blood Group</th>
            <th>Report donor</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($run_query)) { ?>
        <tr>
            <td class="hp"><?php print_r($row['donorname']); ?> </td>
            <td class="hp1"><?php print_r($row['contact']); ?> </td>
            <td class="hp2"><?php print_r($row['age']); ?> </td>
            <td class="hp3"><?php print_r($row['bloodgroup']); ?> </td>
            <td class="hp4" hidden><?php print_r($row['iden']); ?> </td>
            <td>
                <button class="reportselect " id="modrep" data-toggle="modal" data-target="#reportmodal">
                    Report</button>
            </td>
        </tr>

        <?php } ?>

        <?php } ?>
        <?php if (mysqli_num_rows($run_query) == 0) { ?>
        <h2 class="nodonorbox">There is no donor available right now matching your blood group and location</h2>
        <?php } ?>

    </table>

    <form action="home.php">
        <div class="homebtn">
            <input type="submit" value="home">
        </div>
    </form>
    <script>
    var f;
    $(function() {
        // ON SELECTING ROW
        $(".reportselect").click(function() {
            //FINDING ELEMENTS OF ROWS AND STORING THEM IN VARIABLES
            var a =
                $(this).parents("tr").find(".hp").text();
            var c =
                $(this).parents("tr").find(".hp1").text();
            var d =
                $(this).parents("tr").find(".hp2").text();
            var e =
                $(this).parents("tr").find(".hp3").text();
            f =
                $(this).parents("tr").find(".hp4").text();
            var p = "";
            // CREATING DATA TO SHOW ON MODEL
            p += "<strong> <p id='a' name='Username' >NAME : " + a + " </p> </strong>";
            p += "<strong> <p id='c' name='Contact'>CONTACT : " + c + "</p> </strong>";
            p += "<strong> <p id='d' name='Age' >AGE : " + d + " </p> </strong>";
            p += "<strong> <p id='e' name='Bloodgroup' >BLOOD GROUP : " + e + " </p> </strong>";
            //CLEARING THE PREFILLED DATA
            $("#divrep").empty();
            //WRITING THE DATA ON MODEL
            $("#divrep").append(p);
        });
    });

    function func() {
        $.ajax({
            type: "POST",
            url: 'report.php',
            data: {
                userid: f
            },
            success: function(data) {
                //alert("success! X:" + data);
            }
        });
        document.getElementById("repbtn").innerHTML = "Reported";
        document.getElementById("repbtn").disabled = true;
    }

    function reset() {
        document.getElementById("repbtn").innerHTML = "Report";
        document.getElementById("repbtn").disabled = false;
    }
    </script>
    <div class="modal fade" id="reportmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- MODEL TITLE -->
                    <h2 class="modal-title" id="reportmodallabel">
                        Report Donor</h2>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×</span>
                    </button>
                </div>
                <!-- MODEL BODY -->
                <div class="modal-body">
                    <div class="Reportclass" id="divrep">
                    </div>
                    <div>
                        <strong> <label for="reason">Choose a REASON to report : </label> </strong>
                        <select name="reason" id="reason">
                            <option value="1"> Wrong Number </option>
                            <option value="2"> Using someone else. </option>
                            <option value="3"> Donor location changed. </option>
                            <option value="4"> Donated recently. </option>
                            <option value="5"> Can't donate anymore. </option>
                            <option value="6"> Denied to donate. </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <!-- The close button in the bottom of the modal -->
                        <button type="button" id="repbtn" onclick="func()" class="btn btn-secondary">
                            Report</button>
                        <button type="button" id="repclose" onclick="reset()" class="btn btn-secondary"
                            data-dismiss="modal">
                            Close</button>
                    </div>




                </div>
            </div>
        </div>
    </div>

</body>

</html>