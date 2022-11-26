<?php
// $url = "https://cdn-api.co-vin.in/api/v2/admin/location/districts/1";
// $json = file_get_contents($url);
// $json_data = json_decode($json, true);

// for ($x = 0; $x <= count($json_data); $x += 1)
//     print_r($json_data['districts'][$x]['district_name'] . ", ");


if (isset($_POST['submit'])) {
    $state = $_POST['stateloc'];
    $district = $_POST['city'];

    $stateurl = "https://cdn-api.co-vin.in/api/v2/admin/location/states";
    $states_info = file_get_contents($stateurl);
    $state_json = json_decode($states_info, true);

    $state_id = -1;

    for ($x = 0; $x < count($state_json['states']); $x += 1) {
        $state_name = $state_json['states'][$x]['state_name'];

        if (strcasecmp($state_name, $state) == 0) {
            $state_id =  $state_json['states'][$x]['state_id'];
        }
    }
    $disrict_url = "https://cdn-api.co-vin.in/api/v2/admin/location/districts/" . $state_id;

    //print_r($disrict_url);
    $district_info = file_get_contents($disrict_url);
    $district_json = json_decode($district_info, true);

    $district_id = -1;

    for ($x = 0; $x < count($district_json['districts']); $x += 1) {
        $district_name = $district_json['districts'][$x]['district_name'];

        if (strcasecmp($district_name, $district) == 0) {
            $district_id =   $district_json['districts'][$x]['district_id'];
        }
    }
    $dis = "district_id=" . $district_id;
    $now = date("d-m-Y");
    $tom = date("d-m-Y", strtotime('tomorrow'));
    //https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id=89&date=19-05-2021
    $vaccine_url = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?" . $dis . "&date=" . $now . "&date=" . $tom;
    //print_r($vaccine_url);
    $vaccine_info = file_get_contents($vaccine_url);
    $vaccine_json = json_decode($vaccine_info, true);



    // for ($x = 0; $x < count($vaccine_json['sessions']); $x += 1) {
    //     print_r("Vaccine name: " . $vaccine_json['sessions'][$x]['vaccine']);
    //     echo '<br/>';
    //     print_r("Cost: " . $vaccine_json['sessions'][$x]['fee'] . "\n");
    //     echo '<br/>';

    //     print_r("Slots:  ");
    //     echo '<br/>';


    //     for ($y = 0; $y < count($vaccine_json['sessions'][$x]['slots']); $y += 1) {

    //         print_r($vaccine_json['sessions'][$x]['slots'][$y]);
    //         echo '<br/>';
    //     }


    //     print_r("Centre Name: " . $vaccine_json['sessions'][$x]['name']);
    //     echo '<br/>';
    //     print_r("Address: " . $vaccine_json['sessions'][$x]['address']);
    //     echo '<br/>';
    //     print_r("State: " . $vaccine_json['sessions'][$x]['state_name']);
    //     echo '<br/>';
    //     print_r("Dose 1: " . $vaccine_json['sessions'][$x]['available_capacity_dose1']);
    //     echo '<br/>';
    //     print_r("Dose 2: " . $vaccine_json['sessions'][$x]['available_capacity_dose2']);
    //     echo '<br/>';
    //     print_r("Minimum age limit: " . $vaccine_json['sessions'][$x]['min_age_limit']);
    //     echo '<br/>';
    //     echo '<br/>';
    // }
}
?>

<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        background-color: rgb(245, 237, 235);
        align-items: center;
    }

    h1 {
        text-align: center;
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
    }

    tr:nth-child(odd) {
        background-color: #fff;
    }

    input {
        height: auto;
        width: auto;
        border-radius: 10px;
        margin-top: 20px;
        border: 1px solid rgb(253, 237, 235);
        background-color: rgb(253, 237, 235);
        color: #000;
        font-size: 12px;
        font-weight: bold;
        padding: 10px 35px;
        margin-left: 42%;
        box-shadow: 5px 5px 10px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;

    }

    .submitbtn {
        margin-left: 46%;
    }
    </style>



</head>

<body>
    <form action="api.php" method="post"><input type="text" placeholder="Enter state" name="stateloc" required><input
            type="text" placeholder="Enter city" name="city" required><input type="submit" class="submitbtn"
            name="submit" value="submit">
    </form>
    <a href="home.php"> <input type="submit" value="Home" class="submitbtn"></a>
    <h1>Vaccine Information</h1>
    <table>
        <tr>
            <th>Vaccine</th>
            <th>Cost</th>
            <th>Centre</th>
            <th>Address</th>
            <th>Dose1</th>
            <th>Dose2</th>
            <th>Min. Age</th>


        </tr>

        <?php if (isset($_POST['submit'])) { ?>
        <?php for ($x = 0; $x < count($vaccine_json['sessions']); $x += 1) {
                    ?><tr>
            <td><?php print_r($vaccine_json['sessions'][$x]['vaccine']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['fee']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['name']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['address']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['available_capacity_dose1']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['available_capacity_dose2']);
                                ?></td>
            <td><?php print_r($vaccine_json['sessions'][$x]['min_age_limit']);
                                ?></td>
        </tr><?php
                            }

                            ?>
        <?php if (count($vaccine_json['sessions']) == 0) { ?>
        <h1>No vaccines available in this area</h1>
        <?php } ?>
        <?php } ?>
    </table>
</body>

</html>