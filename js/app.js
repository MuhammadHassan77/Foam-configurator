$(document).ready(function () {

    // model loading function
    let c = 0;
    let i = setInterval(function () {
        $(".loading-page .counter h1").html(c + "%");
        $(".loading-page .counter hr").css("width", c + "%");
        c++;
        if (c == 101) clearInterval(i);
    }, 48);

    // togglng between tabs
    $(document).on("click", ".nav-link", function (e) {
        e.preventDefault();
        $(".closeBtn").show();
        $(".nav-item").removeClass("activetab")
        $(".sidebar").css("display", "block")
        $(this).parent().addClass("activetab");
        $(".optDiv").addClass("d-none");
        $($(this).attr("data-tab")).removeClass("d-none");
    })

    // closing tabs
    $(".closeBtn,.closeBtn-mob").click(function () {
        $(".closeBtn,.closeBtn-mob").hide();
        $(".sidebar").css("display", "none");
        $(".nav-item").removeClass("activetab")
        $(".optDiv").addClass("d-none");
    });

    // adding active class to foam
    $(document).on("click", ".foam-box", function () {
        $(".foam-box").parent().removeClass("active-foam");
        $(this).parent().addClass("active-foam");
        $(".selectedFoamImg").attr("src", $(this).attr("src"));
    })

    // adding active class to design
    $(document).on("click", ".design-circle", function () {
        $(".design-circle").parent().removeClass("active-design");
        $(this).parent().addClass("active-design");
    })

    // adding active class to panel
    $(document).on("click", ".panel-circle", function () {
        $(".panel-circle").parent().removeClass("active-design");
        $(this).parent().addClass("active-design");
    })

    // adding active class to shape
    $(document).on("click", ".shape-box", function () {
        $(".shape-box").parent().removeClass("active-shape");
        $(this).parent().addClass("active-shape");
    })

    // adding active class to shape
    $(document).on("click", ".size", function () {
        $(".size").removeClass("active-size");
        $(this).addClass("active-size");
    })

    // register function
    $(document).on("click", "#registerBtn", function () {
        let name = $("#fullName").val().trim();
        let email = $("#registerEmail").val().trim();
        let password = $("#registerPassword").val().trim();
        let phone = $("#phoneNumber").val().trim();
        let pattern = /[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,3}/;
        let act = "register";
        // console.log(name, email, password, phone);
        if (name == "" || email == "" || password == "" || phone == "") {
            $(".registerNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>All fields are required!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
        }
        else if (!pattern.test(email)) {

            $(".registerNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Invalid Email!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`);

        }
        else {
            let dataString = `act=${act}&name=${name}&email=${email}&password=${password}&phone=${phone}`;
            // console.log(datastring);
            $.ajax({
                url: "./func.php",
                method: "POST",
                data: dataString,
                caches: false,
                success: (res) => {
                    if (res == 'success') {
                        $(".registerNotify").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Registered successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
                        $("#fullName").val('');
                        $("#registerEmail").val('');
                        $("#registerPassword").val('');
                        $("#phoneNumber").val('');
                    }
                    // console.log(res);
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }
    })

    // login function
    $(document).on("click", "#loginBtn", function () {
        let email = $("#loginEmail").val().trim();
        let password = $("#loginPassword").val().trim();
        let act = "login";
        // console.log(name, email, password, phone);
        if (email == "" || password == "") {
            $(".loginNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>All fields are required!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`)
        }
        else {
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
                        $(".loginNotify").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Login successfully!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                        $("#loginEmail").val("");
                        $("#loginPassword").val("");
                        $(".logoutBtn").removeClass("d-none");
                        $(".createLink").removeClass("d-none");
                        $("#uploadModel").attr({ "data-target": "#upload-model-modal", "data-toggle": "modal" });
                        $(".profileLink").removeClass("d-none");
                        if ($("#currentEmail").val() == "") {
                            $(".hiddenBtns").html(`
                            <div class="btn-group dropup mydropdown ">
                                <i class="fa fa-plus custom-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu">
                                    <div class="">
                                        <button class="btn btn-white h-50 mybtn createLink data-toggle="modal" data-target="#changes-modal"">SAVE CHANGES</button>
                                        <button class="btn btn-white h-50 mybtn logoutBtn" data-toggle="modal" data-target="#logout-modal">LOGOUT</button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-white h-50 mybtn createLink customBtn data-toggle="modal" data-target="#changes-modal"">SAVE CHANGES</button>
                            <button class="btn btn-white h-50 mybtn logoutBtn customBtn" data-toggle="modal" data-target="#logout-modal">LOGOUT</button>
                            `);
                        }
                        setTimeout(() => {
                            $("button.close").trigger("click");
                            $(`.buyNowBtn[data-target="#login-modal"]`).hide();
                            // $(".buyNowBtn").text("BUY NOW");
                            // $(".buyNowBtn").attr("data-target", "#order-modal");
                        }, 800);
                    }
                    else {
                        $(".loginNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Incorrect Email Or Password!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }
    })

    // prevneting button logout and savechanges button not to hide on refresh
    if ($("#currentEmail").val() != "") {
        $("#uploadModel").attr({ "data-target": "#upload-model-modal", "data-toggle": "modal" });
        $(".profileLink").removeClass("d-none");
        $(".hiddenBtns").html(`
        <div class="btn-group dropup mydropdown ">
                    <i class="fa fa-plus custom-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu">
                        <div class="">
                            <button class="btn btn-white h-50 mybtn createLink" data-toggle="modal" data-target="#changes-modal">SAVE CHANGES</button>
                            <button class="btn btn-white h-50 mybtn logoutBtn" data-toggle="modal" data-target="#logout-modal">LOGOUT</button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-white h-50 mybtn createLink customBtn" data-toggle="modal" data-target="#changes-modal">SAVE CHANGES</button>
                <button class="btn btn-white h-50 mybtn logoutBtn customBtn" data-toggle="modal" data-target="#logout-modal">LOGOUT</button>
        `);
    }

    // order now function
    $("#enquiryForm").on('submit', (function (e) {
        e.preventDefault();
        let name = $("#full_name").val().trim();
        let email = $("#enquiryEmail").val().trim();
        let contact_num = $("#contactNumber").val().trim();
        // let uploadImage = $("#uploadImage").val().trim();
        let detail = $("#enquiryDetail").val().trim();
        let url = window.location.origin + window.location.pathname;

        let color = $("#selected-color").val().trim();
        // let shape = $("#selected-shape").val().trim();
        let foam = $("#selected-foam").val().trim();
        let size = $("#selected-size").val().trim();

        var formData = new FormData(this); // Currently empty
        formData.append('color', color);
        formData.append('foam', foam);
        formData.append('size', size);
        formData.append('url', url);

        // if (name == "" || email == "" || contact_num == "" || uploadImage == "" || detail == "") {
        if (name == "" || email == "" || contact_num == "" || detail == "") {
            $(".enquiryNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>All fields are required!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`)
        } else {
            $.ajax({
                url: "func.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: (res) => {
                    res= JSON.parse(res);
                    if (res.result == "success") {
                        // console.log(res);
                        $(".enquiryNotify").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Order placed successfully!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`);
                        $("#full_name").val('');
                        $("#enquiryEmail").val('');
                        $("#contactNumber").val('');
                        $("#uploadImage").val('');
                        $("#enquiryDetail").val('');
                        setTimeout(() => {
                            $("button.close").trigger("click");
                        }, 1500);
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            });
        }
    }));

    let lastId;
    // create link function
    $(document).on("click", ".createLink", function () {
        let color = $("#selected-color").val().trim();
        // let shape = $("#selected-shape").val().trim();
        // let email = $("#currentEmail").val().trim();
        let foam = $("#selected-foam").val().trim();
        let size = $("#selected-size").val().trim();
        // let panel = $("#selected-panel").val().trim();
        let url = window.location.origin + window.location.pathname;
        let act = "createLink";


        // let dataString = `act=${act}&color=${color}&shape=${shape}&foam=${foam}&email=${email}&url=${url}`;
        // let dataString = `act=${act}&color=${color}&foam=${foam}&panel=${panel}&url=${url}`;
        let dataString = `act=${act}&color=${color}&foam=${foam}&size=${size}&url=${url}`;
        // if (color == "" || shape == "" || foam == "") {
        // if (color == "" || foam == "" || panel == "") {
        if (color == "" || foam == "" || size == "") {
            alert("Do Some Chages!!");
        } else {
            $.ajax({
                url: "func.php",
                type: "POST",
                data: dataString,
                cache: false,
                success: (res) => {
                    res = JSON.parse(res);
                    lastId = res['lastId'];
                    // console.log(res);
                    if (res['result'] == "success") {
                        $("#saveChanges").val(url + "?id=" + res['lastId']);
                        alert(url + "?id=" + res['lastId']);
                        setTimeout(() => {
                            $("#changes-modal").show();
                        }, 1000);
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }
    })

    // opening new window for savechanges
    $(document).on("click", "#applyChangesBtn", function () {

        if (lastId !== "" || lastId !== undefined) {
            window.open($("#saveChanges").val(), '_blank').focus();
        } else {
            window.open(window.location.origin + window.location.pathname, '_blank').focus();
        }
    })

    // handling logout button
    $(document).on("click", ".logoutBtn", function () {
        let dataString = `act=logout`;
        $.ajax({
            url: "./func.php",
            method: "POST",
            data: dataString,
            caches: false,
            success: (res) => {
                // console.log(res);
                if (res == "success") {
                    $(".mydropdown").hide()
                    $(".logoutBtn").addClass("d-none");
                    $(".createLink").addClass("d-none");
                    $(".profileLink").addClass("d-none");
                    $("#uploadModel").removeAttr("data-target data-toggle");
                    // $(".hiddenBtns").html(``);
                    setTimeout(() => {
                        $(`.buyNowBtn[data-target="#login-modal"]`).show();
                        // $(".buyNowBtn").text("LOGIN");
                        // $(".buyNowBtn").attr("data-target", "#login-modal");
                    }, 800);
                }
            },
            error: (err) => {
                console.log(err);
            }
        })
    })

    // handling upload new model 
    $("#uploadModelForm").on('submit', (function (e) {
        e.preventDefault();
        let uploadImage = $("#uploadModelImg").val().trim();


        if (uploadImage == "") {
            $(".uploadModelNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please select model!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`)
        } else {
            $.ajax({
                url: "func.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: (res) => {
                    // console.log(res);
                    res = JSON.parse(res);
                    if (res['result'] == "success") {
                        $(".uploadModelNotify").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Model Uploaded successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
                        $("#uploadModelImg").val();
                        setTimeout(() => {
                            $("button.close").trigger("click");
                        }, 1500);
                    } else {
                        $(".uploadModelNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid file type!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            });
        }
    }));


    // order now function
    // $(document).on("click", "#enquiryBtn", function () {
    //     let name = $("#full_name").val().trim();
    //     let email = $("#enquiryEmail").val().trim();
    //     let contact_num = $("#contactNumber").val().trim();
    //     let uploadImage = $("#uploadImage").val().trim();
    //     let detail = $("#enquiryDetail").val().trim();
    //     let act = "ordernow";

    //     // console.log(name, email, contact_num, uploadImage, detail);

    //     if (name == "" || email == "" || contact_num == "" || uploadImage == "" || detail == "") {
    //         $(".enquiryNotify").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //         <strong>All fields are required!</strong>
    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //         </button>
    //     </div>`)
    //     } else {
    //         let dataString = `act=${act}&full_name=${name}&enquiryEmail=${email}&contactNumber=${contact_num}&uploadImage=${uploadImage}&enquiryDetail=${detail}`;

    //         // console.log(dataString);
    //         $.ajax({
    //             url: "./func.php",
    //             method: "POST",
    //             data: dataString,
    //             caches: false,
    // success: (res) => {
    //     if (res == "success") {
    //         // console.log(res);
    //         $(".enquiryNotify").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
    //         <strong>Order placed successfully!</strong>
    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //         </button>
    //     </div>`);
    //         $("#full_name").val('');
    //         $("#enquiryEmail").val('');
    //         $("#contactNumber").val('');
    //         $("#uploadImage").val('');
    //         $("#enquiryDetail").val('');
    //         setTimeout(() => {
    //             $("button.close").trigger("click");
    //         }, 1500);
    //     }
    // },
    // error: (err) => {
    //     console.log(err);
    // }
    //         })

    //     }
    // })



})