<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:home.php");
}
$con = mysqli_connect('localhost', 'root', '1234');

mysqli_select_db($con, 'bdentrydatabase');

if (isset($_POST['senddetails'])) {
    $donorname = $_POST['nom'];
    $bg = $_POST['bloodgroup'];
    $dob = $_POST['birthday'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $city = $_POST['postal'];
    $contact = $_POST['fonction'];
    $now = date("d-m-Y");



    $diff2 = strtotime($dob) - strtotime($now);
    $days = abs(round($diff2 / 86400));
    $age = $days / 365;
    $query = "DELETE from donortable where numreports>100";
    $sql = "INSERT into donortable(donorname,bloodgroup,dateofbirth,gender,stateloc,city,Contact,age,numreports) VALUES('$donorname','$bg','$dob','$gender','$state','$city','$contact','$age','0')";

    if (mysqli_query($con, $sql) && mysqli_query($con, $query)) {
        header("Location:donormodalbox.php");
    } else {
        echo "Error";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
body {
    margin: auto;
    background: rgb(253, 237, 235);
    font-family: 'Open Sans', sans-serif;
}

.nof {
    background-color: rgb(115, 57, 156);
    color: white;
    height: 8px;
    width: 8px;
    padding: 2px;

    border-radius: 5px;
    cursor: pointer;
    margin-top: 3px;
}

.info p {
    text-align: center;
    color: #3f4383;
    text-transform: none;
    font-weight: 600;
    font-size: 15px;
    margin-top: 2px
}

.info i {
    color: #f0967b;
}

form h1 {
    font-size: 18px;
    background: -webkit-linear-gradient(to right, #8f1b42, #e32056);
    background: linear-gradient(to right, #8f1b42, #e32056);
    color: rgb(255, 255, 255);
    padding: 22px 25px;
    border-radius: 5px 5px 0px 0px;
    margin: auto;
    text-shadow: none;
    text-align: left;
}

form {
    border-radius: 5px;
    max-width: 800px;
    width: 100%;
    margin: 1% auto;
    background-color: #FFFFFF;
    overflow: hidden;
}

p span {
    color: #F00;
}

p {
    margin: 0px;
    font-weight: 500;
    line-height: 2;
    color: #333;
}

h1 {
    text-align: center;
    color: #3f4383;
    text-shadow: 1px 1px 0px #FFF;
    margin: 50px 0px 0px 0px
}

input {
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #eee;
    margin-bottom: 15px;
    width: 41%;
    height: 30px;
    float: left;
}

a {
    text-decoration: inherit
}

textarea {
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #EEE;
    margin: 0;
    width: 75%;
    height: 130px;
    float: left;
    padding: 0px 15px;
}

.form-group {
    overflow: hidden;
    clear: both;
}

.icon-case {
    width: 35px;
    float: left;
    border-radius: 5px 0px 0px 5px;
    background: #eeeeee;
    height: 33px;
    position: relative;
    text-align: center;
    line-height: 40px;
}

i {
    color: #555;

}

.contentform {
    padding: 40px 30px;
}

.bouton-contact {
    background: -webkit-linear-gradient(to right, #6b1532, #e32056);
    background: linear-gradient(to right, #6b1532, #e32056);
    color: #FFF;
    text-align: center;
    width: 100%;
    border: 0;
    padding: 17px 25px;
    border-radius: 0px 0px 5px 5px;
    cursor: pointer;
    margin-top: 40px;
    font-size: 18px;
}

.bouton-contact:hover {
    transition: all .3s cubic-bezier(.19, 1, .22, 1);
    background: linear-gradient(to left, #6b1532, #e32056);
    color: #FFF;
    text-align: center;
    width: 100%;
    border: 0;
    padding: 17px 25px;
    border-radius: 0px 0px 5px 5px;
    cursor: pointer;
    margin-top: 40px;
    font-size: 18px;
}

.leftcontact {
    width: 49.5%;
    float: left;
    border-right: 1px dotted #CCC;
    box-sizing: border-box;
    padding: 0px 15px 0px 0px;
}

.rightcontact {
    width: 49.5%;
    float: right;
    box-sizing: border-box;
    padding: 0px 0px 0px 15px;
}

.validation {
    display: none;
    margin: 0 0 10px;
    font-weight: 400;
    font-size: 13px;
    color: #DE5959;
}

#sendmessage {
    border: 1px solid #fff;
    display: none;
    text-align: center;
    margin: 10px 0;
    font-weight: 600;
    margin-bottom: 30px;

    background-color: #EBF6E0;
    color: #5F9025;
    border: 1px solid #B3DC82;
    padding: 13px 40px 13px 18px;
    border-radius: 3px;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.03);
}

#sendmessage.show,
.show {
    display: block;
}
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <h1>YOU'RE A HERO</h1>
    <div class="info"><a target="_blank">
            <p> Everything will be <i class="fa fa-heart" style="font-size:25px; color:red;"></i> OKAY! </p>
        </a></div>

    <form action="donorform.php" method="post" enctype="multipart/form-data">
        <h1>Stay Safe. Better days are on their way.</h1>

        <div class="contentform">
            <div id="sendmessage"> Your message has been sent successfully. Thank you. </div>
            <div class="leftcontact">
                <div class="form-group">
                    <p>Name<span>*</span></p>
                    <span class="icon-case"><i class="fa fa-male" style="font-size:25px" ;></i></span>
                    <input type="text" name="nom" id="nom" data-rule="required" required />
                    <div class="validation"></div>
                </div>

                <div class="form-group" style="height: 70px; margin-top: 3px; margin-bottom: 20px;">
                    <p>Blood Group <span>*</span></p>
                    <select id="blood group" name="bloodgroup" style="border-radius: 5px ;height:30px; width: 80px;"
                        required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>

                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <p>Date of Birth <span>*</span></p>
                    <input type="date" id="birthday" name="birthday" required>
                    <div class="validation"></div>
                </div>

                <div class="form-group">
                    <p>Gender <span>*</span></p>
                    <select id="gender" name="gender"
                        style="border-radius: 5px; margin-bottom: 20px; margin-top: 3px; height:30px;">
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                        <option value="OTHERS">Others</option>
                    </select>
                    <div class="validation"></div>
                </div>




            </div>
            <div class="rightcontact">


                <div class="form-group">
                    <p> State<span>*</span></p>
                    <select name="state" id="state"
                        style=" margin-bottom: 20px; width: 45%; border-radius: 5px; margin-top: 3px;height:30px;"
                        required>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Puducherry">Puducherry</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>

                <div class="form-group">
                    <p>City <span>*</span></p>
                    <span class="icon-case"><i class="fa fa-map-marker" style="font-size:25px"></i></span>
                    <input type="text" name="postal" id="postal" data-rule="required" required />
                </div>
                <div class="form-group">
                    <p>Contact Number <span>*</span></p>
                    <span class="icon-case"><i class="fa fa-phone" style="font-size:25px"></i></span>
                    <input type="tel" id="fonction" name="fonction" class='input-field' pattern="(0/91)?[7-9][0-9]{9}">
                    <div class="validation"></div>
                </div>


            </div>
        </div>
        <button type="submit" name="senddetails" class="bouton-contact click-me">Send</button>


    </form>

    <script>
    $(document).ready(function() {
        $('#contact_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    first_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your phone number'
                            },
                            phone: {
                                country: 'US',
                                message: 'Please supply a vaild phone number with area code'
                            }
                        }
                    },
                    address: {
                        validators: {
                            stringLength: {
                                min: 8,
                            },
                            notEmpty: {
                                message: 'Please supply your street address'
                            }
                        }
                    },
                    city: {
                        validators: {
                            stringLength: {
                                min: 4,
                            },
                            notEmpty: {
                                message: 'Please supply your city'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'Please select your state'
                            }
                        }
                    },
                    zip: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your zip code'
                            },
                            zipCode: {
                                country: 'US',
                                message: 'Please supply a vaild zip code'
                            }
                        }
                    },
                    comment: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 200,
                                message: 'Please enter at least 10 characters and no more than 200'
                            },
                            notEmpty: {
                                message: 'Please supply a description of your project'
                            }
                        }
                    }
                }
            })
            .on('success.form.bv', function(e) {
                $('#success_message').slideDown({
                    opacity: "show"
                }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
    });
    </script>
</body>


</html>