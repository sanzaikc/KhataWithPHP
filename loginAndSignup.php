<?php
session_start();
include_once 'includes/sessionVariables.php';

if (isset($_SESSION['userId'])) {
    header('Location:index.php');
} elseif (isset($_GET['msg']) && $_GET['msg'] != '') {
    echo "<script type=\"text/javascript\">alert(\"" . $_GET['msg'] . "\");</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" type="image/png" href="https://img.icons8.com/ios/50/000000/circled-k.png" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <script src="https://kit.fontawesome.com/d6dae3ac15.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/styles.css">
    <title>Khata</title>
    <style>
    .card {
        position: relative;
    }

    .or {
        position: absolute;
        background-color: white;
        padding: 0 1rem;
        font-weight: bold;
        top: 71.5%;
        left: 45%;
    }
    </style>

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#e3f2fd">
        <div class="container">
            <a class="navbar-brand text-info" href="" style="font-size:1.5rem">Khata</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="offset-lg-1 col-lg-6">
                <svg id="logo" width="606" height="154" viewBox="0 0 606 154" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M83.4 150L36.2 88V150H2V9.6H36.2V71.2L83 9.6H123.2L68.8 78.4L125.2 150H83.4Z"
                        stroke="#B6D3E9" stroke-width="3" />
                    <path
                        d="M210.053 37.2C222.853 37.2 233.12 41.4667 240.853 50C248.586 58.4 252.453 70 252.453 84.8V150H218.453V89.4C218.453 81.9333 216.52 76.1333 212.653 72C208.786 67.8667 203.586 65.8 197.053 65.8C190.52 65.8 185.32 67.8667 181.453 72C177.586 76.1333 175.653 81.9333 175.653 89.4V150H141.453V2H175.653V53.4C179.12 48.4667 183.853 44.5333 189.853 41.6C195.853 38.6667 202.586 37.2 210.053 37.2Z"
                        stroke="#B6D3E9" stroke-width="3" />
                    <path
                        d="M269.419 94C269.419 82.5333 271.552 72.4667 275.819 63.8C280.219 55.1333 286.152 48.4667 293.619 43.8C301.085 39.1333 309.419 36.8 318.619 36.8C326.485 36.8 333.352 38.4 339.219 41.6C345.219 44.8 349.819 49 353.019 54.2V38.4H387.219V150H353.019V134.2C349.685 139.4 345.019 143.6 339.019 146.8C333.152 150 326.285 151.6 318.419 151.6C309.352 151.6 301.085 149.267 293.619 144.6C286.152 139.8 280.219 133.067 275.819 124.4C271.552 115.6 269.419 105.467 269.419 94ZM353.019 94.2C353.019 85.6667 350.619 78.9333 345.819 74C341.152 69.0667 335.419 66.6 328.619 66.6C321.819 66.6 316.019 69.0667 311.219 74C306.552 78.8 304.219 85.4667 304.219 94C304.219 102.533 306.552 109.333 311.219 114.4C316.019 119.333 321.819 121.8 328.619 121.8C335.419 121.8 341.152 119.333 345.819 114.4C350.619 109.467 353.019 102.733 353.019 94.2Z"
                        stroke="#B6D3E9" stroke-width="3" />
                    <path
                        d="M474.161 121V150H456.761C444.361 150 434.694 147 427.761 141C420.828 134.867 417.361 124.933 417.361 111.2V66.8H403.761V38.4H417.361V11.2H451.561V38.4H473.961V66.8H451.561V111.6C451.561 114.933 452.361 117.333 453.961 118.8C455.561 120.267 458.228 121 461.961 121H474.161Z"
                        stroke="#B6D3E9" stroke-width="3" />
                    <path
                        d="M486.411 94C486.411 82.5333 488.544 72.4667 492.811 63.8C497.211 55.1333 503.144 48.4667 510.611 43.8C518.078 39.1333 526.411 36.8 535.611 36.8C543.478 36.8 550.344 38.4 556.211 41.6C562.211 44.8 566.811 49 570.011 54.2V38.4H604.211V150H570.011V134.2C566.678 139.4 562.011 143.6 556.011 146.8C550.144 150 543.278 151.6 535.411 151.6C526.344 151.6 518.078 149.267 510.611 144.6C503.144 139.8 497.211 133.067 492.811 124.4C488.544 115.6 486.411 105.467 486.411 94ZM570.011 94.2C570.011 85.6667 567.611 78.9333 562.811 74C558.144 69.0667 552.411 66.6 545.611 66.6C538.811 66.6 533.011 69.0667 528.211 74C523.544 78.8 521.211 85.4667 521.211 94C521.211 102.533 523.544 109.333 528.211 114.4C533.011 119.333 538.811 121.8 545.611 121.8C552.411 121.8 558.144 119.333 562.811 114.4C567.611 109.467 570.011 102.733 570.011 94.2Z"
                        stroke="#B6D3E9" stroke-width="3" />
                </svg>
            </div>
            <!-- Login and SignUp starts here  -->
            <div class="col-lg-4 mt-4 ">
                <?php
                echo  ErrorMessage();
                echo SuccessMessage();
                ?>
                <div class="card rounded-lg border-0 shadow p-4 mt-5 bg-white">
                    <h2 class="card-title  text-center">Login to Khata</h2>
                    <div class="card-body">
                        <form action="includes/loginHandler.php" method="post">
                            <input class="form-control mb-2" type="text" name="userName" placeholder="Username"
                                required />
                            <input class="form-control mb-2" type="password" name="userPassword" placeholder="Password"
                                required />
                            <div class="remember text-muted">
                                <label for="rememberMe"> Remember Me </label>
                                <input type="checkbox" name="rememberMe" id="rememberMe" disabled />
                            </div>
                            <input class="btn btn-outline-success btn-block" type="submit" value="Login" id="submit" />
                            <hr />
                            <small class="or">Or</small>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal"
                                data-target="#exampleModal">
                                Create New Account
                            </button>
                        </form>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold" id="exampleModalLabel">
                                        Sign Up
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="includes/addUser.php" method="post" class="formData">
                                        <div class="form-group">
                                            <input type="text" class="form-control mb-2" name="firstName"
                                                placeholder="First Name" required />
                                            <input type="text" class="form-control mb-2" name="lastName"
                                                placeholder="Last Name" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control mb-2" name="newUserName"
                                                placeholder="Username" required />
                                            <input type="password" class="form-control mb-2" name="newPassword"
                                                placeholder="New Password" required />
                                        </div>
                                        <div class="form-group ml-2">
                                            <b>I am a:</b>
                                            <input type="radio" name="typeOfUser" id="customer" value="0" required>
                                            <label for="customer">Customer</label>
                                            <input type="radio" name="typeOfUser" id="shopOwner" value="1" required>
                                            <label for="shopOwner">Shop Owner</label>
                                        </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <input type="submit" class="btn btn-outline-success btn-lg " value="Sign Up"
                                        id="submit" />
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login and SignUp Ends here  -->
        </div>
    </div>
    </form>
    <script>
    const logo = document.querySelectorAll('#logo path');
    for (let i = 0; i < logo.length; i++) {
        console.log(`Letter ${i} is ${logo[i].getTotalLength()}`)
    }
    </script>

</body>

</html>