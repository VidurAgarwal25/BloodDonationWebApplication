<?php
session_start();
// if (!isset($_SESSION['username']))
//     header("Location:login.php");
$con = mysqli_connect('localhost', 'root', '1234');
mysqli_select_db($con, 'bdentrydatabase');

$query1 = "SELECT * FROM donortable WHERE bloodgroup='A+'";
$query2 = "SELECT * FROM donortable WHERE bloodgroup='B+'";
$query3 = "SELECT * FROM donortable WHERE bloodgroup='AB+'";
$query4 = "SELECT * FROM donortable WHERE bloodgroup='O+'";
$query5 = "SELECT * FROM donortable WHERE bloodgroup='A-'";
$query6 = "SELECT * FROM donortable WHERE bloodgroup='B-'";
$query7 = "SELECT * FROM donortable WHERE bloodgroup='AB-'";
$query8 = "SELECT * FROM donortable WHERE bloodgroup='O-'";

$res1 = mysqli_query($con, $query1);
$num1 = mysqli_num_rows($res1);

$res2 = mysqli_query($con, $query2);
$num2 = mysqli_num_rows($res2);

$res3 = mysqli_query($con, $query3);
$num3 = mysqli_num_rows($res3);

$res4 = mysqli_query($con, $query4);
$num4 = mysqli_num_rows($res4);

$res5 = mysqli_query($con, $query5);
$num5 = mysqli_num_rows($res5);

$res6 = mysqli_query($con, $query6);
$num6 = mysqli_num_rows($res6);

$res7 = mysqli_query($con, $query7);
$num7 = mysqli_num_rows($res7);

$res8 = mysqli_query($con, $query8);
$num8 = mysqli_num_rows($res8);






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood donation portal</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

    <style>
    .hoverbutton {
        opacity: 0.8;

    }

    .hoverbutton span {
        -webkit-transition: 0.6s;
        -moz-transition: 0.6s;
        -o-transition: 0.6s;
        transition: 0.6s;
        -webkit-transition-delay: 0.2s;
        -moz-transition-delay: 0.2s;
        -o-transition-delay: 0.2s;
        transition-delay: 0.2s;
    }

    .hoverbutton:before,
    .hoverbutton:after {
        content: '';
        position: absolute;
        top: 0.67em;
        left: 0;
        width: 100%;
        text-align: center;
        opacity: 0;
        -webkit-transition: .4s, opacity .6s;
        -moz-transition: .4s, opacity .6s;
        -o-transition: .4s, opacity .6s;
        transition: .4s, opacity .6s;
    }

    /* :before */

    .hoverbutton:before {
        content: attr(data-hover);
        -webkit-transform: translate(-150%, 0);
        -moz-transform: translate(-150%, 0);
        -ms-transform: translate(-150%, 0);
        -o-transform: translate(-150%, 0);
        transform: translate(-150%, 0);
    }

    /* :after */

    .hoverbutton:after {
        content: attr(data-active);
        -webkit-transform: translate(150%, 0);
        -moz-transform: translate(150%, 0);
        -ms-transform: translate(150%, 0);
        -o-transform: translate(150%, 0);
        transform: translate(150%, 0);
    }

    /* Span on :hover and :active */

    .hoverbutton:hover span,
    .hoverbutton:active span {
        opacity: 0;
        -webkit-transform: scale(0.3);
        -moz-transform: scale(0.3);
        -ms-transform: scale(0.3);
        -o-transform: scale(0.3);
        transform: scale(0.3);
    }

    /*  
    We show :before pseudo-element on :hover 
    and :after pseudo-element on :active 
*/

    .hoverbutton:hover:before,
    .hoverbutton:active:after {
        opacity: 1;
        background: linear-gradient(to right, #8f1b42, #e32056);

        -webkit-transform: translate(0, 0);
        -moz-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        -webkit-transition-delay: .4s;
        -moz-transition-delay: .4s;
        -o-transition-delay: .4s;
        transition-delay: .4s;
    }

    /* 
  We hide :before pseudo-element on :active
*/

    .hoverbutton:active:before {

        -webkit-transform: translate(-150%, 0);
        -moz-transform: translate(-150%, 0);
        -ms-transform: translate(-150%, 0);
        -o-transform: translate(-150%, 0);
        transform: translate(-150%, 0);
        -webkit-transition-delay: 0s;
        -moz-transition-delay: 0s;
        -o-transition-delay: 0s;
        transition-delay: 0s;
    }

    .dropbtn {
        background-color: transparent;

        color: black;

        font-size: 1.9rem;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 14px 16px;
        text-decoration: transparent;
        display: block;

    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        background: #fff;

        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: transparent;
    }

    .marquee {
        height: 50px;
        font-size: 20px;
        overflow: hidden;
        position: relative;
        background: #fefefe;
        color: red;



    }

    .marquee p {
        position: absolute;
        width: 120%;
        height: 100%;
        margin: 0;
        line-height: 50px;
        text-align: center;
        -moz-transform: translateX(100%);
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        -moz-animation: scroll-left 2s linear infinite;
        -webkit-animation: scroll-left 2s linear infinite;
        animation: scroll-left 20s linear infinite;
    }

    .footer .box-container .box a:hover {
        color: #e32056;
    }

    .dark .marquee {
        background-color: black;
        color: white;
    }

    @-moz-keyframes scroll-left {
        0% {
            -moz-transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
        }
    }

    @-webkit-keyframes scroll-left {
        0% {
            -webkit-transform: translateX(100%);
        }

        100% {
            -webkit-transform: translateX(-100%);
        }
    }

    @keyframes scroll-left {
        0% {
            -moz-transform: translateX(100%);
            -webkit-transform: translateX(100%);
            transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
        }
    }
    </style>

</head>

<body>

    <script>
    function togglePopup() {
        document.getElementById("popup-1").classList.toggle("active");
    }
    </script>
    <!--
        header section starts  -->

    <header>

        <a href="#" class="logo">bl<span class=""><img style="width: 19px; height:20px;" src="images/blood-drop.svg"
                    alt=""></span>od-Help</a>

        <div id="menu" class="fas fa-bars"></div>

        <nav class="navbar">
            <ul>
                <li><a class="active" href="#home">home</a></li>
                <li><a href="#symtoms">myths&facts</a></li>
                <li><a href="#vaccine">Vaccine Tracker</a></li>

                <li><a href="#handwash">resources</a></li>
                <?php if (isset($_SESSION['username'])) { ?>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn"><?php print_r($_SESSION['username']) ?>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="logout.php">Logout</a>
                            <a href="deletemodalbox.php">Delete Account</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                <li>
                    <a href="login.php">Login/Register</a>

                </li>
                <?php } ?>
                <li><button class="button" id="themedark" onclick="myFunction()"><i class="far fa-moon"></i></button>
                </li>
            </ul>
        </nav>

    </header>


    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home" style="min-height:103vh;">

        <div class="content">

            <span>Let's fight Covid-19</span>
            <h3>We are in this together</h3>
            <p>"Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so
                that we may fear less."</p>
            <a href="#protect" class="btn">Donate Blood</a>
            <a href="#protect1" class="btn">Accept Blood</a>

        </div>

        <div class="image">
            <img src="images/cover.PNG" alt="">
        </div>

    </section>

    <div class="marquee">
        <p>Warning: Do not pay any amount to anyone offering to provide blood or give contact of any donor.
            Kindly report any donor on our site asking for money in exchange of blood.</p>
    </div>
    <!-- home section ends -->

    <section class="protect" id="protect">

        <h1 class="heading">before you <span style="color:#d92054;">donate</span> blood</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/cpic4.png" alt="">
                <h3>Stay hydrated</h3>
                <p>Drink 6 to 8 cups of water or juice the day before and on the day of your donation.</p>
                <a href="https://www.healthline.com/nutrition/7-health-benefits-of-water#1.-Helps-maximize-physical-performance"
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>

            <div class="box">
                <img src="images/cpic5.png" alt="">
                <h3>Get a good night’s sleep.</h3>
                <p>Tired minds don't plan well. sleep first, plan later.</p>
                <a href="https://www.healthline.com/nutrition/10-reasons-why-good-sleep-is-important"
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>

            <div class="box">
                <img src="images/cpic6.png" alt="">
                <h3>save strength</h3>
                <p>After you donate plasma, Don’t exercise hard or for very long.</p>
                <a href="https://blog.nasm.org/fitness/donating-blood-and-exercise-what-athletes-should-know#:~:text=After%20donation%2C%20your%20body%20goes,or%20plasma%20normalizes%20(9)."
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>
            <div>
                <?php if (isset($_SESSION['username'])) { ?>
                <a href="donorform.php" class="btn">Donate Blood</a>
                <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                <a href="login.php"><button style="" class="btn hoverbutton" type="button" data-hover="LOGIN FIRST"
                        data-active="I'M ACTIVE"><span>Donate
                            Blood</span></button></a>
                <?php } ?>
            </div>

        </div>
    </section>

    <h1 id="numberdon1" hidden><?php echo $num1 ?></h1>
    <h1 id="numberdon2" hidden><?php echo $num2 ?></h1>
    <h1 id="numberdon3" hidden><?php echo $num3 ?></h1>
    <h1 id="numberdon4" hidden><?php echo $num4 ?></h1>
    <h1 id="numberdon5" hidden><?php echo $num5 ?></h1>
    <h1 id="numberdon6" hidden><?php echo $num6 ?></h1>
    <h1 id="numberdon7" hidden><?php echo $num7 ?></h1>
    <h1 id="numberdon8" hidden><?php echo $num8 ?></h1>
    <!-- counter -->
    <section class="numberdonor" style="min-height: 80vh;">
        <h1 class="heading">Number of <span style="color:#d92054;">blood </span>donors</h1>
        <div class="box-container">
            <div class="box number">
                <strong>A+</strong>
                <br>
                <p id="a+">0</p>
            </div>
            <div class="box number">
                <strong>B+</strong>
                <br>
                <p id="b+">0</p>
            </div>
            <div class="box number">
                <strong>AB+</strong>
                <br>
                <p id="ab+">0</p>
            </div>
            <div class="box number">
                <strong>O+</strong>
                <br>
                <p id="o+">0</p>
            </div>
        </div>
        <div class="box-container">
            <div class="box number">
                <strong>A -</strong>
                <br>
                <p id="a-">0</p>
            </div>
            <div class="box number">
                <strong>B -</strong>
                <br>
                <p id="b-">0</p>
            </div>
            <div class="box number">
                <strong>AB -</strong>
                <br>
                <p id="ab-">0</p>
            </div>
            <div class="box number">
                <strong>O -</strong>
                <br>
                <p id="o-">0</p>
            </div>
        </div>
    </section>



    <section class="protect" id="protect1">


        <h1 class="heading">after you <span style="color:#d92054;">accept</span> blood</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/h.png" alt="">
                <h3>eat healthy</h3>
                <p>ensure that the patient rests, drinks plenty of fluids and eats nutritious food.</p>
                <a href="https://www.who.int/campaigns/connecting-the-world-to-combat-coronavirus/healthyathome/healthyathome---healthy-diet#:~:text=While%20no%20foods%20or%20dietary,and%20some%20types%20of%20cancer."
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>

            <div class="box">

                <img src="images/social.png" alt="">
                <h3>maintain social distancing</h3>
                <p>place patient in properly ventilated single room.</p>
                <a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/social-distancing.html#:~:text=Social%20distancing%2C%20also%20called%20%E2%80%9Cphysical,both%20indoor%20and%20outdoor%20spaces."
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>

            <div class="box">
                <img src="images/panic2.png" alt="">
                <h3>don't panic</h3>
                <p>don't stress, don't worry. you are blessed! stay calm, stay cool and don't be depressed.</p>
                <a href="https://www.healthline.com/health/anxiety/effects-on-body#:~:text=Long%2Dterm%20anxiety%20and%20panic,headaches%2C%20dizziness%2C%20and%20depression."
                    onclick="window.open(this.href,'_self')" class="btn">learn more</a>
            </div>



            <?php if (isset($_SESSION['username'])) { ?>
            <a style="margin-bottom:10px;" href="acceptorform.php" class="btn">Accept Blood</a>
            <?php } ?>

            <?php if (!isset($_SESSION['username'])) { ?>
            <a href="login.php"><button style="" class="btn hoverbutton" type="button" data-hover="LOGIN FIRST"
                    data-active="I'M ACTIVE"><span>Accept
                        Blood</span></button></a>

            <?php } ?>


        </div>

        </div>

    </section>


    <!-- symtoms section starts  -->

    <!-- prevent section starts  -->

    <section class="prevent" id="symtoms">

        <div class="row">

            <div class="image">
                <img src="images/myth.png" alt="">
            </div>

            <div class="content">
                <h1 class="heading"> <span>Myths</span> about <span style="color:#d92054;">blood </span>donation.</h1>
                <ul>
                    <li>Health deteriorates after donating blood.</li>
                    <li>Taking medication means that one cannot be a blood donor.</li>
                    <li>Giving blood hurts.</li>
                    <li>Age is a deterrent to blood donation.</li>
                    <li>You cannot take part in sports or other physical activities after donating blood.</li>
                    <li>Being a vegetarian, means that the blood does not have enough iron and cannot be donated.</li>

                </ul>
            </div>

        </div>

        <div class="row">

            <div class="content">
                <h1 class="heading"><span>Reality</span> about <span style="color:#d92054;">blood</span> donation.</h1>
                <ul>
                    <li>If you are healthy prior to donation, your recovery is complete in a day or two. It is advised
                        to rest a while after donating. Drinking enough liquids replaces the lost fluid within a couple
                        of hours. The body produces new cells faster after a donation. All the RBCs are replaced within
                        3-4 days and WBCs within 3 weeks.</li>
                    <li>Depending on the medication being taken, it may halt donation for a period, though in many cases
                        it won't prevent a donation. person in charge or the nursing staff should be informed before
                        donating.</li>
                    <li>The pain experienced is no more than a needle prick. The slight soreness that maybe where the
                        needle was is just a reminder of the good deed done.</li>
                    <li>There is no maximum age limit. As long as you are fit and healthy you can give blood.</li>
                    <li>Giving blood does not interfere with ability to perform physically. Advice to avoid heavy
                        lifting or strenuous workouts for the rest of the day is given after the donation. You can get
                        back on track the next day.</li>
                    <li>Vegetarians can donate blood. The iron needed is taken from body stores and once a balanced diet
                        is maintained is replaced after donation. This usually normally takes a month or so.</li>
                </ul>
            </div>

            <div class="image">
                <img src="images/ph1.png" alt="">
            </div>

        </div>

    </section>

    <!-- symtoms section ends -->


    <section class="prevent vaccine" id="vaccine">
        <div class="row">
            <div class="boxes">
                <p class="heading">FAQs</p>
                <div class="faqs">
                    <details>
                        <summary>Which COVID-19 vaccines are licensed in India?</summary>
                        <p class="text">Two vaccines that have been granted emergency use authorization by the Central
                            Drugs Standard Control Organization (CDSCO) in India are Covishield® (AstraZeneca's vaccine
                            manufactured by Serum Institute of India) and Covaxin® (manufactured by Bharat Biotech
                            Limited).</p>
                    </details>
                    <details>
                        <summary>Have the vaccines undergone the needed clinical trials before EUA?</summary>
                        <p class="text">Both the Indian COVID-19 vaccines have completed their Phase I & II trials.
                            Covishield® has completed its Phase III trials in UK and the bridging trial in India.</p>
                    </details>
                    <details>
                        <summary>If I have received vaccine as a health worker, how will my family members receive the
                            vaccine (as they are exposed as well)?</summary>
                        <p class="text">The people at highest risk of exposure such as health care and frontline workers
                            will receive the vaccine on priority. These personnel are also likely source of infection of
                            their family members. Other family members will be vaccinated according to the age specific
                            prioritization by the Government of India.</p>
                    </details>
                    <details>
                        <summary>
                            Is COVISHIELD® same as the vaccine been given in UK by Astrazeneca?
                        </summary>
                        <p class="text">Yes, Covishield® vaccine, manufactured by the Serum Institute of India, is based
                            on the same patent technology as the Astrazeneca vaccine.</p>
                    </details>

                    <details>
                        <summary>
                            What is the dose schedule of both the vaccines?
                        </summary>
                        <p class="text">The time interval between two doses of the Covishield vaccine has been extended
                            from four-six weeks to four-eight weeks. The second dose of Covaxin can be taken four to six
                            weeks after the first.</p>
                    </details>

                    <details>
                        <summary>
                            Can a person presently having COVID-19 (confirmed or suspected) infection be vaccinated?
                        </summary>
                        <p class="text">Person with confirmed or suspected COVID-19 infection may increase the risk of
                            spreading the same to others at vaccination site. For this reason, infected individuals
                            should defer vaccination for 14 days after symptoms resolution.</p>
                    </details>

                    <details>
                        <summary>
                            Do I need to use the mask/other COVID-19 appropriate precautions after receiving the
                            vaccine?
                        </summary>
                        <p class="text">Yes, it is absolutely necessary that everyone who has received the COVID-19
                            vaccine should continue to follow the COVID-19 appropriate behaviour i.e., mask, do gaj ki
                            doori and hand sanitization to protect themselves and those around from spreading the
                            infection.</p>
                    </details>

                    <details>
                        <summary>
                            What precautions I need to take after receiving the vaccine?
                        </summary>
                        <p class="text">Both the vaccines are safe but in case of any discomfort or complaint, ask the
                            beneficiary to visit the nearest health facility and/or call the health worker whose phone
                            number is given in the Co-WIN SMS received after vaccination.</p>
                    </details>

                    <details>
                        <summary>
                            Is it important for me to receive the same vaccine during second dose?
                        </summary>
                        <p class="text">As the vaccines available are not interchangeable, it is important to receive
                            the second dose of same vaccine as the first one. The Co-WIN portal is also going to help to
                            ensure that everyone receives the same vaccine.</p>
                    </details>
                    <details>
                        <summary>
                            Where should I register for the vaccination?
                        </summary>
                        <p class="text">Register on the Co-WIN Portal and schedule your vaccination appointment.
                            https://www.cowin.gov.in/home</p>
                    </details>


                    <details>
                        <summary>
                            Will I get any certificate that I am vaccinated?
                        </summary>
                        <p class="text">Yes, a provisional certificate would be provided after the first dose. On
                            completion of second dose, when you receive the message for completion of schedule it would
                            include a link to download digital certificate of vaccination for your perusal.</p>
                    </details>
                </div>
            </div>

        </div>
        <div class="vacc" style="display: flex;justify-content: center;align-items: center; margin-top:-50px;">
            <a href="api.php" class="btn">vaccine tracker</a>
        </div>

    </section>






    <!-- handwash section starts  -->
    <section class="handwash" id="handwash" style="min-height: 80vh; ">

        <h1 class="heading">Covid-19 and it's resources <span style="color:#d92054;">#IndiaFightsCorona</span></h1>
        <div class="box-container">
            <div class="box">
                <p><a href="https://covid19.uk.gov.in/bedssummary.aspx" target="_blank">covid19.uk.gov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://self4society.mygov.in/" target="_blank">self4society.mygov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://web.umang.gov.in/web_new/login?redirect_to=&utm_source=MyGov&utm_medium=MyGovCovid-19"
                        target="_blank">web.umang.gov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://covidhelp.teamsaath.me/dl/ewAiAHQAIgA6ADAALAAiAHMAIgA6ACIAYwBsAGEAcwBzAC0AUwBoAGUAZQB0ADEAIgAsACIAcgAiADoAIgBzAGIAQgBGAHoAMAA4ADgAUgBiAC0AbgBZAEIAZAB4AEMAVABCAEgAWQBBACIALAAiAG4AIgA6ACIAQQBtAGIAdQBsAGEAbgBjAGUAIABTAGUAcgB2AGkAYwBlAHMAIgB9AA%3D%3D"
                        target="_blank">covidhelp.teamsaath.me</a></p>
            </div>
            <div class="box">
                <p><a href="https://external.sprinklr.com/insights/explorer/dashboard/601b9e214c7a6b689d76f493/tab/46?id=DASHBOARD_601b9e214c7a6b689d76f493&tabId=46&home=1"
                        target="_blank">sprinklr</a></p>
            </div>
            <div class="box">
                <p><a href="https://www.cowin.gov.in/home" target="_blank">cowin.gov.in</a></p>
            </div>

            <div class="box">
                <p><a href="https://www.mygov.in/covid-19" target="_blank">mygov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://www.aarogyasetu.gov.in/applink/" target="_blank">aarogyasetu.gov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://www.mohfw.gov.in/" target="_blank">mohfw.gov.in</a></p>
            </div>
            <div class="box">
                <p><a href="https://www.nhp.gov.in/" target="_blank">nhp.gov.in</a></p>
            </div>
        </div>
    </section>
    <!-- handwash section ends -->


    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>about us</h3>
                <p>Covid-Shield is a portal developed to help people in these trying times and get information and
                    resources about Covid 19 in India</p>
            </div>

            <div class="box">
                <h3>locations</h3>
                <a href="#">Dehradun,India</a>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#home">home</a>
                <a href="#symtoms">Myth&facts</a>
                <a href="#handwash">Resources</a>
                <?php if (isset($_SESSION['username'])) { ?>
                <a href="logout.php"><?php echo $_SESSION['username'] ?></a>
                <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                <a href="login.php">Login/Register</a>
                <?php } ?>
            </div>


            <div class="box">
                <h3>contact info</h3>
                <p> <i class="fas fa-phone"></i> +123-456-7890. </p>
                <p> <i class="fas fa-envelope"></i> covid.mailings@gmail.com </p>
                <p> <i class="fas fa-map-marker-alt"></i> dehradun, india - 248001. </p>
                <div class="share">
                    <a href="#" class="fab fa-youtube"></a>
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>

        </div>


    </section>

    <!-- footer section ends -->

    <!-- scroll top  -->

    <a href="#home" class="scroll-top">
        <img src="images/scroll-img.png" alt="">
    </a>








    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="script.js"></script>
    <script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark");

    }
    </script>


</body>

</html>