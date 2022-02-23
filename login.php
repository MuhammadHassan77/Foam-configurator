<?php
require_once("./func.php");

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>MAN WITH NO NAME</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="./img/logo.png" sizes="16x16" type="image/png">
    <link rel="icon" href="./img/logo.png">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/72a9c1090f.js" crossorigin="anonymous"></script>

</head>

<body class="text-muted">

    <div class="container-fluid">
        <div class="row align-items-center" style="height: 80vh;">
            <div class="col-12 d-flex justify-content-center">
                <img class="card-img-top" style="width:300px" src="./img/logo.png">
            </div>
            <div class="card shadow-lg offset-lg-4 col-lg-4 offset-md-3 col-md-6 offset-sm-1 col-sm-10">
                <div class="card-body py-5">
                    <!-- <h4 class="card-title text-center">Login</h4> -->
                    <div class="loginNotify"></div>
                    <div class="form-group mb-2">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" />
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="loginBtn">Log In</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    $(document).ready(function() {
        // login function
        $(document).on("click", "#loginBtn", function() {
            let email = $("#loginEmail").val().trim();
            let password = $("#loginPassword").val().trim();
            let act = "adminlogin";
            // console.log(name, email, password, phone);
            if (email == "" || password == "") {
                $(".loginNotify").html(`<div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>All fields are required!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`)
            } else {
                let dataString = `act=${act}&email=${email}&password=${password}`;
                // console.log(datastring);
                $.ajax({
                    url: "./func.php",
                    method: "POST",
                    data: dataString,
                    caches: false,
                    success: (res) => {
                        if (res == "success") {
                            // console.log(res);
                            $(".loginNotify").html(`<div class="alert alert-success alert-dismissible  show" role="alert">
                        <strong>Login successfully!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`);
                            $("#loginEmail").val("");
                            $("#loginPassword").val("");
                            setTimeout(() => {
                                window.location.href = "./admin.php"
                            }, 1000);
                        } else {
                            $(".loginNotify").html(`<div class="alert alert-danger alert-dismissible  show" role="alert">
                        <strong>Incorrect Email Or Password!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`);
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            }
        })
    })
</script>

</html>