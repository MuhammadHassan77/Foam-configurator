<?php
require_once("./func.php");

if (isset($_SESSION["id"]) && isset($_SESSION["email"])) {
    // echo $_SESSION["id"].$_SESSION["email"];
?>

    <!DOCTYPE html>
    <html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>FOAM UI</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="icon" href="./img/logo.png" sizes="16x16" type="image/png">
        <link rel="icon" href="./img/logo.png">
        <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta name="theme-color" content="#7952b3">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="./css/dashboard.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/72a9c1090f.js" crossorigin="anonymous"></script>

    </head>

    <body class="text-muted">

        <header class="navbar navbar-dark bg-light sticky-top flex-md-nowrap p-0 shadow">
            <a class="navbar-brand bg-light col-md-3 col-lg-2 me-0 p-0 d-flex justify-content-center " href="">
                <img class="img-fluid" src="./img/logo.png" style="height:45px" alt="">
            </a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <button type="button" class="btn btn-outline-dark px-3 me-2 logoutBtn" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active navigator" aria-current="page" href="#dash-tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navigator" href="#order-tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                    Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navigator" href="#save-tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file" aria-hidden="true">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    Save Changes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navigator" href="#profile-tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                    Reports
                                </a>
                            </li>
                             <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers" aria-hidden="true">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                    <polyline points="2 17 12 22 22 17"></polyline>
                                    <polyline points="2 12 12 17 22 12"></polyline>
                                </svg>
                                Integrations
                            </a>
                        </li> -->
                        </ul>

                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                    <div class="container-fluid tab" id="dash-tab">
                        <div class="row m-2">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                    <h1 class="h2"><i class="fa fa-tachometer-alt"></i> Dashboard</h1>
                                </div>
                                <div class="row p-5">
                                    <div class="card col-4 border-0">
                                        <div class="card-body bg-primary shadow navigator" style="border-radius:.375rem" href="#order-tab">
                                            <h5 class="card-title py-4 text-white fa-2x" role="button">
                                                <i class="fa fa-shopping-cart"></i> Orders
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card col-4 border-0">
                                        <div class="card-body bg-success shadow navigator" style="border-radius:.375rem" href="#save-tab">
                                            <h5 class="card-title py-4 text-white fa-2x" role="button">
                                                <i class="fa fa-file"></i> Save Changes
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="card col-4 border-0">
                                        <div class="card-body bg-info shadow navigator" style="border-radius:.375rem" href="#profile-tab">
                                            <h5 class="card-title py-4 text-white fa-2x" role="button">
                                                <i class="fa fa-user-edit"></i> Profile
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="container-fluid d-none tab" id="order-tab">
                        <div class="row m-2">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                    <h1 class="h2"><i class="fa fa-shopping-cart"></i> Orders</h1>
                                </div>

                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Enquiry Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = "SELECT * FROM orders WHERE userid=" . $_SESSION['id'];
                                        $result = mysqli_query($mysqli, $q);
                                        // print_r($result);
                                        $i = 1;
                                        foreach ($result as $rows) {
                                            $orderid = $rows['orderid'];
                                            $name = $rows['fullname'];
                                            $email = $rows['email'];
                                            $phone = $rows['phone'];
                                            $image = $rows['image'];
                                            $detail = $rows['enquirydetail'];
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $phone; ?></td>
                                                <td> <img class="img-fluid" width="100" height="100" src="./img/<?php echo $image; ?>" alt=""></td>
                                                <td><?php echo $detail; ?></td>
                                            </tr>
                                        <?php }
                                        $i++;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid d-none tab" id="save-tab">
                        <div class="row m-2">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                    <h1 class="h2"><i class="fa fa-file"></i> Save Changes</h1>
                                </div>

                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Save Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = "SELECT * FROM saveurl WHERE userid=" . $_SESSION['id'];
                                        $result = mysqli_query($mysqli, $q);
                                        // print_r($result);
                                        $i = 1;
                                        foreach ($result as $rows) {
                                            $id = $rows['id'];
                                            $url = $rows['url'];
                                            $savedate = $rows['savedate'];
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $url; ?>
                                                    <a class="text-muted text-decoration-none px-1" style="float:right" href="<?php echo $url; ?>" target="_blank"> <i class="fas fa-external-link-square-alt"></i> open</a>
                                                </td>
                                                <td><?php echo $savedate; ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="container-fluid d-none tab" id="profile-tab">
                        <div class="row m-2">
                            <?php
                            $q = "SELECT * FROM users WHERE id=" . $_SESSION['id'];
                            $result = mysqli_query($mysqli, $q);
                            if ($result->num_rows === 1) {
                                while ($rows = $result->fetch_assoc()) {
                                    $id = $rows['id'];
                                    $name = $rows['name'];
                                    $email = $rows['email'];
                                    $phone = $rows['phone'];
                            ?>
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                            <h1 class="h2"><i class="fa fa-user-edit"></i> Profile</h1>
                                        </div>
                                        <div id="profileNotify"></div>
                                        <div class="mb-3">
                                            <input type="hidden" id="userId" value="<?php echo $id; ?>">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control custom-input" id="name" value="<?php echo $name; ?>" readonly placeholder="John Doe">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" class="form-control custom-input" id="email" value="<?php echo $email; ?>" readonly placeholder="name@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control custom-input" id="phone" value="<?php echo $phone; ?>" readonly placeholder="09092-9920">
                                        </div>
                                        <div class="mb-3 edit-div">
                                            <button class="btn btn-outline-info editBtn">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                        </div>
                                        <div class="mb-3 submit-div d-none">
                                            <button class="btn btn-outline-success mx-2 submitBtn">
                                                <i class="fa fa-check"></i> Submit
                                            </button>
                                            <button class="btn btn-outline-secondary mx-2 cancelBtn">
                                                <i class="fa fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>

                </main>
            </div>
        </div>
        <!-- hidden fields -->
        <input type="hidden" id="currentEmail" value="<?php echo (!empty($_SESSION['email'])) ? $_SESSION['email'] : ""; ?>">
        <!-- hidden fields -->

        <!-- Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-title text-success">Logout Successsfully!!</h4>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- <script src="./js/upload.js"></script> -->
        <!-- <script src="./js/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> -->


    </body>
    <script>
        $(document).ready(function() {
            // handling toggling between tabs
            $(document).on("click", ".navigator", function(e) {
                e.preventDefault();
                $(".tab").addClass("d-none");
                $(".navigator").removeClass("active");
                $($(this).attr("href")).removeClass("d-none");
                $(this).addClass("active");
            })
            // hadling edit profile
            $(".editBtn").click(function() {
                $(".edit-div").addClass("d-none");
                $(".submit-div").removeClass("d-none");
                $(".custom-input").removeAttr("readonly");
                $(".custom-input").eq(0).focus();
            })
            $(".cancelBtn").click(function() {
                $(".submit-div").addClass("d-none");
                $(".edit-div").removeClass("d-none");
                $(".custom-input").attr("readonly", "readonly");
            })
            // hadling edit profile btn
            $(".submitBtn").click(function() {
                let id = $("#userId").val().trim();
                let name = $("#name").val().trim();
                let email = $("#email").val().trim();
                let phone = $("#phone").val().trim();
                let dataString = `act=updateProfile&id=${id}&name=${name}&email=${email}&phone=${phone}`;
                if (id == "" || name == "" || email == "" || phone == "") {
                    $("#profileNotify").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>All Fields Are Required!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `);
                } else {
                    $.ajax({
                        type: "POST",
                        url: "./func.php",
                        data: dataString,
                        cache: false,
                        success: function(res) {
                            console.log(res)
                            // res = JSON.parse(res);
                            if (res == "success") {
                                $("#profileNotify").html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Profile Updated Successfully!</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        `);
                                $(".cancelBtn").trigger("click")
                            } else {
                                $("#profileNotify").html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Something Went Wrong!</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                    `);
                            }
                        },
                        error: err => console.log(err)
                    });
                }
            })


            // handling logout button
            $(document).on("click", ".logoutBtn", function() {
                let dataString = `act=logout`;
                $.ajax({
                    url: "./func.php",
                    method: "POST",
                    data: dataString,
                    caches: false,
                    success: (res) => {
                        // console.log(res);
                        if (res == "success") {
                            setTimeout(function() {
                                window.location.href = "./index.php";
                            }, 1000)
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            })
        })
    </script>

    </html>
<?php
} else {
    echo "<script>window.location.href='./index.php'</script>";
}
?>
?>