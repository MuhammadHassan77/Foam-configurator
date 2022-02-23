$(document).ready(function () {

    // UPLOAD COMPONENTS HANDLING

    // designA function
    $("#designA").change(function () {

        if ($('#designA').val() == '') {
            // alert('Please selet file');
            $("#designANotify").html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please Upload Image!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `);
        }
        $.ajax({
            type: "POST",
            url: "./func.php?act=uploadDesignA",
            data: new FormData(document.getElementById("designAForm")),
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                res = JSON.parse(res);
                // console.log(res)
                if (res['result'] == "Uploaded" && res['status'] == "200") {
                    $('#designA').val("");
                    $("#designANotify").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Deisgn A Uploaded Successfully!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `);
                } else {
                    $("#designANotify").html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Something Went Wrong Or Invalid File Type!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
                }
            },
            error: err => console.log(err)
        });
    });

    // designB function
    $("#designB").change(function () {

        if ($('#designB').val() == '') {
            // alert('Please selet file');
            $("#designBNotify").html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please Upload Image!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
        }
        $.ajax({
            type: "POST",
            url: "./func.php?act=uploadDesignB",
            data: new FormData(document.getElementById("designBForm")),
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                res = JSON.parse(res);
                // console.log(res)
                if (res['result'] == "Uploaded" && res['status'] == "200") {
                    $('#designB').val("");
                    $("#designBNotify").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Design B  Uploaded Successfully!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            `);
                } else {
                    $("#designBNotify").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Something Went Wrong Or Invalid File Type!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        `);
                }
            },
            error: err => console.log(err)
        });
    });


})