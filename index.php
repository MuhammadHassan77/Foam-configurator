<?php
require_once('./func.php');
// Turn off all error reporting
error_reporting(0);

// Report simple running errors
error_reporting(E_ERROR | E_WARNING);

// session_start();
// $foamColor = array("#4CBB17", "#FF4500", "#B4A472", "#800080", "#FF1493", "#00adef", "#000000", "#ff0000", "#1818fd", "#fdfdfd", "#008000", "#808080", "#ffff00", "#C00FF0", "#00ffff", "#228B22", "#800000", "#291506", "#291506", "#A9A9A9", "#191970", "#DAA520", "#C41E3A", "#ff0081");

if (isset($_SESSION["id"]) && isset($_SESSION["email"])) {
    // echo $_SESSION["email"];
    // $btn = '<button class="btn btn-white h-50 mybtn buyNowBtn" data-toggle="modal"
    // data-target="#order-modal">BUY NOW</button>';
    // $btn = '<button class="btn btn-white h-50 mybtn buyNowBtn" style="display:none;" data-toggle="modal"
    // data-target="#login-modal">LOGIN</button>';
    // $btn = '<button class="btn btn-white buyNowBtn mybtn" data-toggle="modal" data-target="#order-modal">BUY NOW <i class="fa fa-shopping-cart"></i></button>';
    // $logoutBtn = '<button class="btn btn-white h-50 mybtn" id="logoutBtn" data-toggle="modal" data-target="#logout-modal">LOGOUT</button>';
    // $changesBtn = '<button class="btn btn-white h-50 mybtn" id="createLink" data-toggle="modal" data-target="#changes-modal">SAVE CHANGES</button>';
} else {
    // echo $_SESSION["email"];
    // $btn = '<button class="btn btn-white h-50 mybtn buyNowBtn" data-toggle="modal"
    // data-target="#login-modal">LOGIN</button>';
    // $logoutBtn = "";
    // $changesBtn = "";
}

// FETCHING DATA ON BEHALF PARTICULAR ID
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $q = "SELECT * FROM savechanges WHERE id=" . $id;

    $result = mysqli_query($mysqli, $q);

    if ($result) {
        foreach ($result as $rows) {
            $color = $rows['color'];
            $shape = $rows['shape'];
            $foam = $rows['foam'];
            $panel = $rows['panel'];
            $size = $rows['size'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./img/logo.png" sizes="16x16" type="image/png">
    <link rel="icon" href="./img/logo.png">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src="https://kit.fontawesome.com/72a9c1090f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href='./css/style.css'>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


    <title>BITISTUDIO</title>
    <style type="text/css">
        .claraplayer span,
        .claraplayer svg,
        .profileLink,
        #uploadModel {
            display: none !important;
        }
    </style>
</head>

<body>

    <!-- PAGE LOADER -->
    <div class="mdloading d-none">
        <div class="ld">
            <div class="loader"></div>
        </div>
        <div class="loading-page">
            <div class="counter">
                <p>Building Model</p>
                <h1>0%</h1>
                <hr style="width: 100%;">
            </div>
        </div>
    </div>
    <!-- PAGE LOADER END -->



    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-sm">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav desktop-ui">
                <li class="nav-item">
                    <span class="nav-link p-0" data-tab="#foam-opt">DESIGN</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link p-0" data-tab="#color-opt">COLORS </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link p-0 d-none" data-tab="#size-opt">SIZE </span>
                </li>
                <!--<li class="nav-item">
                    <span class="nav-link p-0" data-tab="#panel-opt">PANEL </span>
                </li>
                 <li class="nav-item">
                    <span class="nav-link p-0" data-tab="#shape-opt">SHAPES </span>
                </li> -->
            </ul>
            <ul class="icon-list">
                <i class="fa fa-paperclip custom-icons ml-auto" id="uploadModel" style="transform: rotate(315deg);" aria-hidden="true"></i>
                <i class="fa fa-globe custom-icons" aria-hidden="true"></i>
                <a href="./myprofile.php" class="d-none custom-icons profileLink" target="_blank" style="padding: 3% !important;">
                    <i class="fa fa-user-edit custom-icons" aria-hidden="true"></i></a>
                <div class="d-flex hiddenBtns">
                    <?php // echo $changesBtn; echo $logoutBtn; 
                    ?>
                    <!-- button will be shown by jquery -->
                </div>
            </ul>
            <?php echo $btn; ?>
            <button class="btn btn-white buyNowBtn mybtn" data-toggle="modal" data-target="#order-modal">BUY NOW <i class="fa fa-shopping-cart"></i></button>
            <!-- <button class="btn btn-white h-50 mybtn" data-toggle="modal" data-target="#login-modal">LOGIN</button> -->
        </div>
        <a class="navbar-brand p-0 m-0" href="">
            <img class="brand-img" src="./img/logo.png" alt="">
        </a>
    </nav>
    <!-- NAVBAR END -->

    <!-- MAIN START -->
    <div class="container-fluid p-0">
        <div class="row p-0 m-0">

            <!-- start-desk -->
            <div class="desktop-ui">
                <!-- SIDEBAR START -->
                <div class="col-3 m-0 p-0 sidebar">

                    <!-- FOAM DIV -->
                    <div class="col-12 p-0 optDiv d-none" data-id="foam-opt" id="foam-opt">
                        <div class="card">
                            <h5 class="card-header">FOAMS
                                <div class="closeBtn">&times;</div>
                                <!-- <div class="closeBtn-mob">&times;</div> -->
                            </h5>
                            <div class="card-body">
                                <div class="row p-0 m-0 patternx60">
                                    <?php getDynamicPattern_60(); ?>
                                </div>
                                <div class="row p-0 m-0 patternx120 d-none">
                                    <?php getDynamicPattern_120(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FOAM DIV -->

                    <!-- COLOR OF SHAPE DIV -->
                    <div class="col-12 p-0 optDiv d-none" data-id="color-opt" id="color-opt">
                        <div class="card">
                            <h5 class="card-header">DESIGNS
                                <div class="closeBtn">&times;</div>
                                <!-- <div class="closeBtn-mob">&times;</div> -->
                            </h5>
                            <div class="card-body">
                                <!-- <input type="color" class="foam-box" data-color="#4CBB17" id="clr-picker"> -->
                                <div class="row p-0 m-0">
                                    <div class="col-12 p-0 design-header">
                                        <img src="./patterns/B/1b.png" class="foam-img w-25 h-100 selectedFoamImg" alt="...">
                                        <h6 class="h6 m-0 text-center">SELECTED DESIGN</h6>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#d4bb7e" style="color: #d4bb7e;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#c69958" style="color: #c69958;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#5d2906" style="color: #5d2906;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#82490b" style="color: #82490b;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#b76f20" style="color: #b76f20;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#f4bc7c" style="color: #f4bc7c;"></i>
                                        <p class="mypara">WOOD</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#5c2414" style="color: #5c2414;"></i>
                                        <p class="mypara">LIGHT GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#FF4500" style="color: #FF4500;"></i>
                                        <p class="mypara">ORANGE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#B4A472" style="color: #B4A472;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle foam-clr" data-color="#800080" style="color: #800080;"></i>
                                        <p class="mypara">PRUPLE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#FF1493" style="color: #FF1493;"></i>
                                        <p class="mypara">PINK</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#00adef" style="color: #00adef;"></i>
                                        <p class="mypara">LIGHT BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#000000" style="color: #000000;"></i>
                                        <p class="mypara">BLACK</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#ff0000" style="color: #ff0000;"></i>
                                        <p class="mypara">RED</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#1818fd" style="color: #1818fd;"></i>
                                        <p class="mypara">BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#fdfdfd" style="color: #fdfdfd;"></i>
                                        <p class="mypara">WHITE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#008000" style="color: #008000;"></i>
                                        <p class="mypara">GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#808080" style="color: #808080;"></i>
                                        <p class="mypara">GRAY</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#ffff00" style="color: #ffff00;"></i>
                                        <p class="mypara">YELLOW</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#C00FF0" style="color: #C00FF0;"></i>
                                        <p class="mypara">PURPLE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#00ffff" style="color: #00ffff;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#228B22" style="color: #228B22;"></i>
                                        <p class="mypara">LIGHT GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#800000" style="color: #800000;"></i>
                                        <p class="mypara">MAROON</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#291506" style="color: #291506;"></i>
                                        <p class="mypara">DARK BROWN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#291506" style="color: #291506;"></i>
                                        <p class="mypara">BROWN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#A9A9A9" style="color: #A9A9A9;"></i>
                                        <p class="mypara">SILVER</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#191970" style="color: #191970;"></i>
                                        <p class="mypara">DARK BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#DAA520" style="color: #DAA520;"></i>
                                        <p class="mypara">LIGHT YELLOW</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#C41E3A" style="color: #C41E3A;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle design-circle" data-color="#ff0081" style="color: #ff0081;"></i>
                                        <p class="mypara">LIGHT PINK</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- COLOR OF SHAPE DIV -->

                    <!-- COLOR OF SHAPE DIV -->
                    <div class="col-12 p-0 optDiv d-none" data-id="size-opt" id="size-opt">
                        <div class="card">
                            <h5 class="card-header">SIZE
                                <div class="closeBtn">&times;</div>
                            </h5>
                            <div class="card-body">
                                <div class="row p-0 m-0">
                                    <div class="col-6 text-center effect size to60 active-size" data-size="to60">
                                        <img src="./img/square.png" class="img-fluid" alt="">
                                        <p class="mypara">60 X 60</p>
                                    </div>
                                    <div class="col-6 text-center effect size to120" data-size="to120">
                                        <img src="./img/rectangle.png" class="img-fluid w-100" alt="" style="height:85%;transform: rotate(90deg);">
                                        <p class="mypara">120 X 60</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- COLOR OF SHAPE DIV -->

                    <!-- COLOR OF PANEL DIV -->
                    <!-- <div class="col-12 p-0 optDiv d-none" data-id="panel-opt" id="panel-opt">
                        <div class="card">
                            <h5 class="card-header">PANEL
                                <div class="closeBtn">&times;</div>
                            </h5>
                            <div class="card-body">
                                <div class="row p-0 m-0">
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#4CBB17" style="color: #4CBB17;"></i>
                                        <p class="mypara">LIGHT GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#FF4500" style="color: #FF4500;"></i>
                                        <p class="mypara">ORANGE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#B4A472" style="color: #B4A472;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#800080" style="color: #800080;"></i>
                                        <p class="mypara">PRUPLE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#FF1493" style="color: #FF1493;"></i>
                                        <p class="mypara">PINK</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#00adef" style="color: #00adef;"></i>
                                        <p class="mypara">LIGHT BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#000000" style="color: #000000;"></i>
                                        <p class="mypara">BLACK</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#ff0000" style="color: #ff0000;"></i>
                                        <p class="mypara">RED</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#1818fd" style="color: #1818fd;"></i>
                                        <p class="mypara">BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#fdfdfd" style="color: #fdfdfd;"></i>
                                        <p class="mypara">WHITE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#008000" style="color: #008000;"></i>
                                        <p class="mypara">GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#808080" style="color: #808080;"></i>
                                        <p class="mypara">GRAY</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#ffff00" style="color: #ffff00;"></i>
                                        <p class="mypara">YELLOW</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#C00FF0" style="color: #C00FF0;"></i>
                                        <p class="mypara">PURPLE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#00ffff" style="color: #00ffff;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#228B22" style="color: #228B22;"></i>
                                        <p class="mypara">LIGHT GREEN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#800000" style="color: #800000;"></i>
                                        <p class="mypara">MAROON</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#291506" style="color: #291506;"></i>
                                        <p class="mypara">DARK BROWN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#291506" style="color: #291506;"></i>
                                        <p class="mypara">BROWN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#A9A9A9" style="color: #A9A9A9;"></i>
                                        <p class="mypara">SILVER</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#191970" style="color: #191970;"></i>
                                        <p class="mypara">DARK BLUE</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#DAA520" style="color: #DAA520;"></i>
                                        <p class="mypara">LIGHT YELLOW</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#C41E3A" style="color: #C41E3A;"></i>
                                        <p class="mypara">CYAN</p>
                                    </div>
                                    <div class="col-4 text-center effect">
                                        <i class="fa fa-circle panel-circle" data-color="#ff0081" style="color: #ff0081;"></i>
                                        <p class="mypara">LIGHT PINK</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> -->
                    <!-- COLOR OF PANEL DIV -->

                    <!-- SHAPE DIV -->
                    <div class="col-12 p-0 optDiv d-none" data-id="shape-opt" id="shape-opt">
                        <div class="card">
                            <h5 class="card-header">SHAPES
                                <div class="closeBtn">&times;</div>
                                <!-- <div class="closeBtn-mob">&times;</div> -->
                            </h5>
                            <div class="card-body">
                                <div class="row p-0 m-0">
                                    <div class="col-6 text-center">
                                        <img class="shape-box" src="./img/foam.png" data-shape="http://3dsium.com/foam/img/panesl.png" style="width: 6vw;">
                                        <p class="mypara">SHAPE 01</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <img class="shape-box" src="./img/foam.png" data-shape="http://3dsium.com/foam/img/panesl.png" style="width: 6vw;">
                                        <p class="mypara">SHAPE 02</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SHAPE DIV -->

                </div>
                <!-- SIDEBAR END -->

            </div>
            <!-- end-desk -->

            <!-- start-mbl -->
            <div class="mbl-ui">
                <div class="container-fluid p-0 m-0">

                    <!-- start-footer-bar -->
                    <div class="footer-bar">

                        <!-- start-arrow-btn -->
                        <div class="row justify-content-center p-0 m-0">
                            <div class="col-4 arrow-width p-0 m-0">
                                <div class="arrow-collapse">
                                    <div class="ac-inner">
                                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end-arrow-btn -->

                        <!-- start-main-content-div -->
                        <div class="row main-row p-0 m-0">
                            <div class="col-12 p-0 m-0">

                                <div class="row text-center justify-content-center p-0 m-0">
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 m-0">
                                        <div id="main-categry" class="carousel slide" data-ride="carousel" data-interval="false">
                                            <div class="carousel-inner menu-h2">
                                                <div class="carousel-item active">
                                                    <h2>Design</h2>
                                                </div>
                                                <div class="carousel-item">
                                                    <h2>Colors</h2>
                                                </div>
                                                <!-- <div class="carousel-item">
                                                    <h2>Size</h2>
                                                </div> -->
                                            </div>
                                            <a class="carousel-control-prev" href="#main-categry" role="button" data-slide="prev">
                                                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                                                <span id="prev-cate" data-tab="size-opt">
                                                    <img src="img/prev1.svg" class="img-fluid">
                                                </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#main-categry" role="button" data-slide="next">

                                                <span id="next-cate">
                                                    <img src="img/next1.svg" class="img-fluid">
                                                </span>
                                                <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end-col-8 -->
                                </div>

                                <!-- start-design-option -->
                                <div class="mobDiv design-opt">

                                    <div class="col-12 p-0 optDiv">

                                        <span class="prev-foam-design">
                                            <img src="img/prev1.svg" class="img-fluid">
                                        </span>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row flex-nowrap p-0 m-0 patternx60">
                                                    <?php getDynamicPattern_60(); ?>
                                                </div>
                                                <div class="row flex-nowrap p-0 m-0 patternx120 d-none">
                                                    <?php getDynamicPattern_120(); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="next-foam-design">
                                            <img src="img/next1.svg" class="img-fluid">
                                        </span>

                                    </div>

                                </div>
                                <!-- end-design-option -->

                                <!-- start-color-option -->
                                <div class="mobDiv color-opt" style="display:none;">
                                    <div class="col-12 p-0 optDiv">

                                        <div class="row p-0 m-0">
                                            <div class="col-12 p-0 design-header">
                                                <img src="./patterns/B/1b.png" class="foam-img w-25 h-100 selectedFoamImg" alt="...">
                                                <h6 class="h6 m-0 text-center">SELECTED DESIGN</h6>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row flex-nowrap clr-act-main p-0 m-0">
                                                    <div class="col-12 p-0 m-0">
                                                        <div id="colorscarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                                                            <div class="carousel-inner menu-h2">

                                                                <!-- <div class="row flex-nowrap clr-act-main p-0 m-0"> -->
                                                                <div class="carousel-item active">
                                                                    <div class="row p-0 m-0">
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#d4bb7e" style="color: #d4bb7e;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#c69958" style="color: #c69958;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#5d2906" style="color: #5d2906;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#82490b" style="color: #82490b;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#b76f20" style="color: #b76f20;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#f4bc7c" style="color: #f4bc7c;"></i>
                                                                            <p class="mypara">WOOD</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="row p-0 m-0">
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#4CBB17" style="color: #4CBB17;"></i>
                                                                            <p class="mypara">L. GREEN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#FF4500" style="color: #FF4500;"></i>
                                                                            <p class="mypara">ORANGE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#B4A472" style="color: #B4A472;"></i>
                                                                            <p class="mypara">CYAN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#800080" style="color: #800080;"></i>
                                                                            <p class="mypara">PRUPLE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#FF1493" style="color: #FF1493;"></i>
                                                                            <p class="mypara">PINK</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#00adef" style="color: #00adef;"></i>
                                                                            <p class="mypara">L. BLUE</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="row p-0 m-0">
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#ff0000" style="color: #ff0000;"></i>
                                                                            <p class="mypara">RED</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#1818fd" style="color: #1818fd;"></i>
                                                                            <p class="mypara">BLUE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#fdfdfd" style="color: #fdfdfd;"></i>
                                                                            <p class="mypara">WHITE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#008000" style="color: #008000;"></i>
                                                                            <p class="mypara">GREEN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#808080" style="color: #808080;"></i>
                                                                            <p class="mypara">GRAY</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#ffff00" style="color: #ffff00;"></i>
                                                                            <p class="mypara">YELLOW</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="row p-0 m-0">
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#00ffff" style="color: #00ffff;"></i>
                                                                            <p class="mypara">CYAN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#228B22" style="color: #228B22;"></i>
                                                                            <p class="mypara">L. GREEN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#800000" style="color: #800000;"></i>
                                                                            <p class="mypara">MAROON</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#291506" style="color: #291506;"></i>
                                                                            <p class="mypara">D. BROWN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#291506" style="color: #291506;"></i>
                                                                            <p class="mypara">BROWN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#A9A9A9" style="color: #A9A9A9;"></i>
                                                                            <p class="mypara">SILVER</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="row p-0 m-0">
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#C41E3A" style="color: #C41E3A;"></i>
                                                                            <p class="mypara">CYAN</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#ff0081" style="color: #ff0081;"></i>
                                                                            <p class="mypara">L. PINK</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#000000" style="color: #000000;"></i>
                                                                            <p class="mypara">BLACK</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#C00FF0" style="color: #C00FF0;"></i>
                                                                            <p class="mypara">PURPLE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#191970" style="color: #191970;"></i>
                                                                            <p class="mypara">D. BLUE</p>
                                                                        </div>
                                                                        <div class="col-2 p-0 m-0 text-center effect">
                                                                            <i class="fa fa-circle design-circle foam-clr" data-color="#DAA520" style="color: #DAA520;"></i>
                                                                            <p class="mypara">L. YELLOW</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <a class="carousel-control-prev" href="#colorscarousel" role="button" data-slide="prev">
                                                                <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                                                                <span id="" data-tab="size-opt">
                                                                    <img src="img/prev1.svg" class="img-fluid">
                                                                </span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next" href="#colorscarousel" role="button" data-slide="next">

                                                                <span id="">
                                                                    <img src="img/next1.svg" class="img-fluid">
                                                                </span>
                                                                <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- end-col-8 -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end-color-option -->

                                <!-- start-size-option -->
                                <!-- <div class="mobDiv size-opt" style="display:none;">

                                    <div class="col-12 p-0 optDiv">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row justify-content-center p-0 m-0">
                                                    <div class="col-4 text-center effect size to60" data-size="to60">
                                                        <span class="hide-size-chk size-check1"><i class="bg-white far fa-check-circle"></i></span>
                                                        <img src="./img/square.png" class="img-fluid" alt="">
                                                        <p class="mypara">60 X 60</p>
                                                    </div>
                                                    <div class="col-4 text-center effect size to120 d-none" data-size="to120">
                                                        <span class="hide-size-chk size-check2"><i class="bg-white far fa-check-circle"></i></span>
                                                        <img src="./img/rectangle.png" class="img-fluid w-100" alt="" style="height:85%;transform: rotate(90deg);">
                                                        <p class="mypara">120 X 60</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div> -->
                                <!-- end-size-option -->
                            </div>
                        </div>
                        <!-- end-main-content-div -->

                    </div>
                    <!-- end-footer-bar -->

                </div>
            </div>
            <!-- end-mbl -->

            <!-- CANVAS START -->
            <div class="col-9 p-0 m-0 canvas-div">
                <!-- <div class="closeBtn">&times;</div> -->

                <div id="clara-embed" style="width: 500px; height: 90vh;"></div>
                <!-- <div id="clara-embed" style="width: 100%; height: 676px;"></div> -->
                <script src="https://clara.io/js/claraplayer.min.js"></script>
                <script src="./js/var.js"></script>
                <script>
                    var clara = claraplayer('clara-embed');
                    clara.on('loaded', function() {
                        // $("#loadingPercentage").text("100%");
                        console.log('Clara player is loaded and ready');
                        $('.mdloading').hide();
                        <?php //if (!empty($color) && !empty($shape) && !empty($foam)) { 
                        ?>
                        <?php // if (!empty($color) && !empty($foam) && !empty($panel)) { 
                        ?>
                        <?php if (!empty($color) && !empty($foam) && !empty($size)) { ?>

                            $(".foam-box").each(function() {
                                if ($(this).data("design1") == "<?php echo $foam; ?>") {
                                    ($(this).trigger("click"));
                                }
                            })



                            // $(".shape-box").each(function() {
                            //     if ($(this).data("shape") == "<?php //echo $shape; 
                                                                    ?>") {
                            //         ($(this).trigger("click"));
                            //     }
                            // })

                            $(".design-circle").each(function() {
                                if ($(this).data("color") == "<?php echo $color; ?>") {
                                    // $(".nav-link[data-tab='#color-opt']").trigger("click");
                                    $(this).trigger("click");
                                }
                            })

                            let size = `<?php echo $size; ?>`;
                            $(`.${size}`).trigger("click");

                            ($(".selectedFoamImg").attr("src", "<?php echo $foam; ?>"));

                            // $(".panel-circle").each(function() {
                            //     if ($(this).data("color") == "<?php //echo $panel; 
                                                                    ?>") {
                            //         $(".nav-link[data-tab='#panel-opt']").trigger("click");
                            //         $(this).trigger("click");
                            //     }
                            // })

                        <?php } ?>

                    });
                    // Fetch and initialize the sceneId
                    clara.sceneIO.fetchAndUse(model_id);
                </script>

            </div>
            <!-- CANVAS END -->
        </div>
    </div>
    <!-- MAIN START -->

    <!-- HIDDEN INPUTS FOR COLOR, SHAPE, FOAM -->
    <input type="hidden" id="selected-color" value="<?= !empty($color) ? $color : "white" ?> ">
    <!-- <input type="hidden" id="selected-shape"> -->
    <input type="hidden" id="selected-foam" value="<?= !empty($foam) ? $foam : "https://3dsium.com/faom_mob_ui/patterns/A/1a.png" ?> ">
    <!-- <input type="hidden" id="selected-panel"> -->
    <input type="hidden" id="selected-size" value="<?= !empty($size) ? $size : "to60" ?> ">
    <input type="hidden" id="currentEmail" value="<?php echo (!empty($_SESSION['email'])) ? $_SESSION['email'] : ''; ?>">
    <!-- HIDDEN INPUTS FOR COLOR, SHAPE, FOAM -->

    <!-- ORDER MODAL -->
    <div class="modal fade" id="order-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="enquiryForm" action="./func.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="enquiryNotify"></div>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="john doe" />
                        </div>
                        <div class="form-group">
                            <label for="enquiryEmail">Email address</label>
                            <input type="email" class="form-control" id="enquiryEmail" name="enquiryEmail" placeholder="sample@exm.com" />
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="0*****" />
                        </div>
                        <!-- <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="uploadImage" name="uploadImage">
                            <label class="custom-file-label" for="uploadImage">Choose file</label>
                        </div> -->
                        <div class="form-group">
                            <label for="enquiryDetail">Enquiry Detail</label>
                            <textarea class="form-control" id="enquiryDetail" placeholder="Address" name="enquiryDetail" rows="3" style="resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary mybtn2" id="enquiryBtn">Enquiry</button>
                        <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ORDER MODAL END -->

    <!-- LOGIN MODAL -->
    <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="loginNotify"></div>
                    <div class="form-group">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" />
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary mybtn2" id="loginBtn">Login</button>
                    <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal" data-toggle="modal" data-target="#register-modal">Register</button>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN MODAL END -->

    <!-- REGISTER MODAL -->
    <div class="modal fade" id="register-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="registerNotify"></div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" />
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email address</label>
                        <input type="email" class="form-control" id="registerEmail" name="registerEmail" />
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" class="form-control" id="registerPassword" name="registerPassword" />
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone #</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary mybtn2" id="registerBtn">Register</button>
                    <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</button>
                </div>
            </div>
        </div>
    </div>
    <!-- REGISTER MODAL END -->

    <!-- CHANGES MODAL -->
    <div class="modal fade" id="changes-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Save Changes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="changesNotify"></div>
                    <div class="form-group">
                        <label for="saveChanges">Click Ok to open with Save Changes.</label>
                        <input type="text" class="form-control" id="saveChanges" readonly />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary mybtn2" id="applyChangesBtn">Ok</button>
                    <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CHANGES MODAL END -->

    <!-- LOGOUT MODAL -->
    <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="h5 text-success">Logout Successfully!!</h5>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary mybtn2" id="applyChangesBtn">Ok</button>
                    <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- LOGOUT MODAL END -->

    <!-- UPLOAD NEW MODEL MODAL -->
    <div class="modal fade" id="upload-model-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Model</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadModelForm" action="./func.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="uploadModelNotify"></div>
                        <p class="mypara">Upload Only png file</p>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="uploadModelImg" name="uploadModelImg">
                            <label class="custom-file-label" for="uploadModelImg">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary mybtn2" id="uploadModelBtn">Upload</button>
                        <button type="button" class="btn btn-outline-secondary mybtn2" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- UPLOAD NEW MODEL MODAL END -->


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<script src="./js/app.js"></script>
<script src="./js/func.js"></script>
<script src="./js/bitcolor.js"></script>
<script src="./js/myjs.js"></script>


</html>