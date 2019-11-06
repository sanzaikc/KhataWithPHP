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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Economica|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
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
    <title>Khata</title>
</head>

<body class="bg-light">
    <div class="container ">
        <div class="row mt-5 pt-5 ">
            <div class="col-lg-8 d-none d-sm-block d-md-block ">
                <svg id="logo" width="606" height="200" viewBox="0 0 1209 424" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M224.878 3.57497C230.257 3.95827 234.739 5.29986 238.325 7.59974C241.911 9.8996 243.704 13.3494 243.704 17.9491C243.704 22.1655 210.086 85.6034 142.85 208.263L261.185 416.975H241.015C219.051 416.975 203.811 415.25 195.294 411.801C187.226 407.967 179.606 399.151 172.434 385.352L74.9423 208.263L187.898 3H197.984C210.983 3 219.947 3.19166 224.878 3.57497ZM65.5293 38.0729V381.902C65.5293 399.535 63.2881 409.884 58.8057 412.951C54.7715 415.634 40.8761 416.975 17.1195 416.975H3V3H17.1195C40.8761 3 54.7715 4.53325 58.8057 7.59974C63.2881 10.2829 65.5293 20.4406 65.5293 38.0729Z"
                        stroke="#B6D3E9" stroke-width="5" />
                    <path
                        d="M374.724 382.477C374.724 399.726 372.259 409.884 367.329 412.951C362.398 415.634 344.917 416.975 314.885 416.975V3C344.468 3 361.726 4.53325 366.656 7.59974C371.587 10.2829 374.052 20.4406 374.052 38.0729V119.718L426.496 104.194C471.768 104.194 499.335 114.735 509.196 135.817C519.057 156.899 523.988 199.638 523.988 264.034V416.975C493.956 416.975 476.25 415.634 470.872 412.951C465.941 409.884 463.476 399.726 463.476 382.477V263.459C463.476 227.428 462.355 202.321 460.114 188.139C457.873 173.573 454.287 164.182 449.356 159.966C444.874 155.749 438.598 153.449 430.53 153.066L368.673 168.59L374.724 184.689V382.477Z"
                        stroke="#B6D3E9" stroke-width="5" />
                    <path
                        d="M714.869 179.514L715.541 163.99C715.541 158.624 714.869 155.749 713.524 155.366C712.18 154.983 710.611 154.216 708.818 153.066C707.025 151.533 704.56 151.149 701.422 151.916C698.732 152.683 695.371 152.874 691.337 152.491L655.029 156.516C645.616 157.666 637.548 158.241 630.824 158.241C624.101 158.241 618.946 156.899 615.36 154.216C611.774 151.533 608.188 139.267 604.602 117.418L682.596 104.194C714.421 104.194 734.367 106.302 742.436 110.519C750.504 114.352 756.331 117.61 759.917 120.293C763.503 122.976 765.968 128.343 767.313 136.392C769.554 146.358 770.675 162.074 770.675 183.539V416.975C744.677 416.975 728.316 415.825 721.593 413.526C714.869 411.226 711.283 405.668 710.835 396.851L655.029 421C642.479 421 633.066 420.808 626.79 420.425C620.963 420.425 614.912 418.892 608.637 415.825C602.809 412.759 598.775 409.692 596.534 406.626C594.741 403.559 592.948 397.043 591.155 387.077C588.914 375.194 587.793 350.854 587.793 314.056V274.384C587.793 231.07 631.945 208.646 720.248 207.113L714.869 193.314V179.514ZM650.995 372.128C651.443 372.128 674.079 364.845 718.903 350.279L712.18 333.605V265.184L717.559 251.96C699.181 252.343 683.044 253.877 669.149 256.56C655.253 259.243 648.306 262.884 648.306 267.484L647.633 343.38C647.633 362.545 648.754 372.128 650.995 372.128Z"
                        stroke="#B6D3E9" stroke-width="5" />
                    <path
                        d="M967.208 108.219C967.208 130.067 964.743 143.675 959.812 149.041C955.33 154.024 941.658 156.516 918.798 156.516H899.3L905.351 170.89V284.733C905.351 317.315 906.696 339.738 909.385 352.004C912.523 363.887 918.798 370.595 928.211 372.128H979.31V416.975L924.849 419.85C902.438 419.85 887.646 417.934 880.474 414.1C873.302 410.267 867.923 407.201 864.337 404.901C860.751 402.601 857.614 398.001 854.924 391.102C852.235 383.819 850.218 378.069 848.873 373.853C847.528 369.253 846.408 361.204 845.511 349.704C845.063 337.822 844.839 328.047 844.839 320.381V170.89L850.218 156.516H814.583V108.219H850.218L844.839 86.945V57.6218C874.871 57.6218 892.352 58.9633 897.283 61.6465C902.662 63.9464 905.351 72.9542 905.351 88.6699L899.972 108.219H967.208Z"
                        stroke="#B6D3E9" stroke-width="5" />
                    <path
                        d="M1150.19 179.514L1150.87 163.99C1150.87 158.624 1150.19 155.749 1148.85 155.366C1147.5 154.983 1145.94 154.216 1144.14 153.066C1142.35 151.533 1139.88 151.149 1136.75 151.916C1134.06 152.683 1130.7 152.874 1126.66 152.491L1090.35 156.516C1080.94 157.666 1072.87 158.241 1066.15 158.241C1059.43 158.241 1054.27 156.899 1050.69 154.216C1047.1 151.533 1043.51 139.267 1039.93 117.418L1117.92 104.194C1149.75 104.194 1169.69 106.302 1177.76 110.519C1185.83 114.352 1191.66 117.61 1195.24 120.293C1198.83 122.976 1201.29 128.343 1202.64 136.392C1204.88 146.358 1206 162.074 1206 183.539V416.975C1180 416.975 1163.64 415.825 1156.92 413.526C1150.19 411.226 1146.61 405.668 1146.16 396.851L1090.35 421C1077.8 421 1068.39 420.808 1062.12 420.425C1056.29 420.425 1050.24 418.892 1043.96 415.825C1038.13 412.759 1034.1 409.692 1031.86 406.626C1030.07 403.559 1028.27 397.043 1026.48 387.077C1024.24 375.194 1023.12 350.854 1023.12 314.056V274.384C1023.12 231.07 1067.27 208.646 1155.57 207.113L1150.19 193.314V179.514ZM1086.32 372.128C1086.77 372.128 1109.4 364.845 1154.23 350.279L1147.5 333.605V265.184L1152.88 251.96C1134.51 252.343 1118.37 253.877 1104.47 256.56C1090.58 259.243 1083.63 262.884 1083.63 267.484L1082.96 343.38C1082.96 362.545 1084.08 372.128 1086.32 372.128Z"
                        stroke="#B6D3E9" stroke-width="5" />
                </svg>
                <section class="intro text-muted">
                    <h1><i class="fas fa-tasks"></i> Manage your creditors/debtors.</h1>
                    <h1><i class="fas fa-money-check-alt"></i> Pay your dues.</h1>
                </section>
            </div>

            <!-- Login and SignUp starts here  -->
            <div class="col-lg-4 mt-4 ">
                <?php
                echo  ErrorMessage();
                echo SuccessMessage();
                ?>
                <div class="card rounded-lg border-0 shadow p-4 bg-white custom">
                    <h2 class="card-title text-center">Log into Khata</h2>
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
                            <input class="btn btn-outline-success btn-block" type="submit" value="Log In" id="submit" />
                            <hr />
                            <small class="or">Or</small>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal"
                                data-target="#exampleModal">
                                Create New Account
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center">
                                <h4 class="modal-title font-weight-bold" id="exampleModalLabel">
                                    Sign Up
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="includes/addUser.php" method="post">
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
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Sign up as:</label>
                                            <select class="form-control" name="typeOfUser"
                                                id="exampleFormControlSelect1" onchange="toggle()" required>
                                                <option value="1">Shop Owner</option>
                                                <option value="0">Customer</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="shopName" style="display:block">
                                            <label for="nameOfShop">Name of the Shop:</label>
                                            <input type="text" id="nameOfShop" class="form-control" name="shopName">
                                        </div>
                                    </div>
                            </div>
                            <div class=" modal-footer d-flex justify-content-center">
                                <input type="submit" class="btn btn-outline-success btn-lg " value="Sign Up"
                                    id="submit" />
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login and SignUp Ends here  -->
        </div>
        <footer class="footer">
            <div class="row mt-5 ">
                <div class="col-md-12 py-3">
                    <div class="  d-flex justify-content-center">
                        <a class="social" href="https://www.facebook.com/sanzai.kc">
                            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-3x" id="social-fb"> </i>
                        </a>
                        <a class="social">
                            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-3x" id="social-tw"> </i>
                        </a>
                        <a class="social">
                            <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-3x" id="social-gp"> </i>
                        </a>
                        <a class="social">
                            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-3x" id="social-fb"> </i>
                        </a>
                        <a class="social">
                            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-3x" id="social-gp"> </i>
                        </a>
                        <a class="social">
                            <i class="fab fa-pinterest fa-lg white-text fa-3x" id="social-gp"> </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright text-center py-2">© 2019 Copyright & Designed by:
                <span class="text-muted"> Sanjay Khatri</span>
            </div>
        </footer>
    </div>
    </form>

    <script>
    // const logo = document.querySelectorAll('#logo path');
    // for (let i = 0; i < logo.length; i++) {
    //     console.log(`Letter ${i} is ${logo[i].getTotalLength()}`)
    // }
    function toggle() {
        var cont = document.getElementById('shopName');
        if (cont.style.display == 'block') {
            cont.style.display = 'none';
        } else {
            cont.style.display = 'block';
        }
    }
    </script>
</body>

</html>