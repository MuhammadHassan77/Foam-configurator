<?php
require("./dbconnect.php");

session_start();

function getFileNames($folderPath)
{
    $fileNames = array();
    if ($handle = opendir($folderPath)) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {
                $fileNames[] = $entry;
                // echo "$entry" . "<br>";
            }
        }
        return $fileNames;

        closedir($handle);
    }
}

function countFiles($folderPath)
{
    $dir = opendir($folderPath); # This is the directory it will count from
    $i = 0; # Integer starts at 0 before counting

    # While false is not equal to the filedirectory
    while (false !== ($file = readdir($dir))) {
        if (!in_array($file, array('.', '..')) && !is_dir($file)) $i++;
    }
    return $i;
    // echo "There were $i files"; # Prints out how many were in the directory
}

// ENCRPYTION EMAIL
function encrypt($password)
{
    // Store the cipher method 
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';

    // Store the encryption key 
    $encryption_key = "scraping";

    // Use openssl_encrypt() function to encrypt the data 
    $encrypt_pass = openssl_encrypt(
        $password,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    return $encrypt_pass;
}

// echo encrypt("m.hassanshaikh77@gmail.com");

function decrypt($encrypt_pass)
{
    $ciphering = "AES-128-CTR";

    $options = 0;

    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121';

    // Store the decryption key 
    $decryption_key = "scraping";

    // Use openssl_decrypt() function to decrypt the data 
    $decrypt_pass = openssl_decrypt(
        $encrypt_pass,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    return $decrypt_pass;
}
// echo decrypt("ZmdmgRzOr8haTw==");
// exit;



function getDynamicPattern_60()
{
    global $mysqli;
    $res = mysqli_query($mysqli, "SELECT * FROM pattern60 WHERE id BETWEEN 1 AND 56");
    foreach ($res as $rows) {
        $id = $rows['id'];
        $name = $rows['name'];
        $url_A = $rows['url_A'];
        $url_B = $rows['url_B'];
?>
        <div class="col-3 col-sm-6 p-0 text-center effect active-foam-div">
            <img class="foam-box" src="<?= $url_B; ?>" data-design1="http://3dsium.com/foam_mob_ui/<?= $url_A; ?>" data-design2="http://3dsium.com/foam_mob_ui/<?= $url_B; ?>">
            <p class="mypara"><?= $name; ?></p>
        </div>
    <?php   }
}

function getDynamicWoodPattern_60()
{
    global $mysqli;
    $res = mysqli_query($mysqli, "SELECT * FROM pattern60 where id between 57 and 112");
    foreach ($res as $rows) {
        $id = $rows['id'];
        $name = $rows['name'];
        $url_A = $rows['url_A'];
        $url_B = $rows['url_B'];
    ?>
        <div class="col-3 col-sm-6 p-0 text-center effect active-foam-div">
            <img class="foam-box" src="<?= $url_B; ?>" data-design1="http://3dsium.com/foam_mob_ui/<?= $url_A; ?>" data-design2="http://3dsium.com/foam_mob_ui/<?= $url_B; ?>">
            <p class="mypara"><?= $name; ?></p>
        </div>
    <?php   }
}

function getDynamicPattern_120()
{
    global $mysqli;
    $res = mysqli_query($mysqli, "SELECT * FROM pattern120");
    foreach ($res as $rows) {
        $id = $rows['id'];
        $name = $rows['name'];
        $url_A = $rows['url_A'];
        $url_B = $rows['url_B'];
    ?>
        <div class="col-3 col-sm-6 p-0 text-center effect active-foam-div">
            <img class="foam-box" src="<?= $url_B; ?>" data-design1="http://3dsium.com/foam_mob_ui/<?= $url_A; ?>" data-design2="http://3dsium.com/foam_mob_ui/<?= $url_B; ?>">
            <p class="mypara"><?= $name; ?></p>
        </div>

<?php   }
}

// echo "<div style='display:flex'><div style='background-color:black;'>";
// getDynamicPattern_60();
// echo "</div>";
// echo "<div style='background-color:black;'>";
// getDynamicPattern_120();
// echo "</div></div>";
// exit;

function createLink($email, $forOrder, $orderlastId)
{
    global $mysqli;
    // if (!empty($_POST["color"]) && !empty($_POST["shape"]) && !empty($_POST["foam"]) && !empty($_POST["email"]) && !empty($_POST["url"])) {
    // if (!empty($_POST["color"]) && !empty($_POST["foam"]) && !empty($_POST["panel"]) && !empty($_POST["url"])) {
    if (!empty($_POST["color"]) && !empty($_POST["foam"]) && !empty($_POST["size"]) &&  !empty($_POST["url"])) {
        $color = $_POST['color'];
        $size = $_POST['size'];
        $foam = $_POST['foam'];
        $url = $_POST['url'];
        // $email = !empty($_SESSION['email']) ? $_SESSION['email'] : $email;
        $email = $email;
        $id = !empty($_SESSION['id']) ? $_SESSION['id'] : 1;
        // echo $email . $id;
        // exit;
        // $shape = $_POST['shape'];
        // $email = $_POST['email'];
        // $panel = $_POST['panel'];

        // $q = 'INSERT INTO savechanges (color,shape,foam)
        // VALUES ("' . $color . '", "' . $shape . '","' . $foam . '") ';

        // VALUES ("' . $color . '", "","' . $foam . '","' . $panel . '") ';

        $q = 'INSERT INTO savechanges (color,shape,foam,panel,size)
            VALUES ("' . $color . '", "","' . $foam . '","","' . $size . '" ) ';

        $result = mysqli_query($mysqli, $q);

        $lastId = $mysqli->insert_id;

        if ($result) {

            $sql = 'INSERT INTO saveurl(url,email,savedate,userid)
                VALUES("' . $url . "?id=" . $lastId . '","' . $email . '","' . date("h:i:sa d-m-Y") . '" ,  "' . $id . '" )';

            if ($forOrder)
                $result = mysqli_query($mysqli, "UPDATE orders SET designUrl='$url?id=$lastId' WHERE orderid=$orderlastId");

            $res = mysqli_query($mysqli, $sql);

            if ($res)
                echo '{ "result": "success","lastId":"' . $lastId . '"}';
            else
                echo "error";
        } else {
            echo "error";
        }
    }
}

if (isset($_POST['act']) && $_POST['act'] == "register") {

    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["phone"])) {

        $q = "INSERT INTO users(name, email, password, phone) 
        VALUES('" . $_POST['name'] . "','" . $_POST['email'] . "','" . encrypt($_POST['password']) . "','" . $_POST['phone'] . "') ";

        $result = mysqli_query($mysqli, $q);

        if ($result) {
            // foreach ($result as $rows) {
            //     session_start();
            //     $_SESSION["id"] = $rows["id"];
            //     $_SESSION["email"] = $rows["email"];
            //     $password = $rows["password"];
            //     $phone = $rows["phone"];
            // }
            echo "success";
        } else {
            echo "error";
        }
    }
} elseif (isset($_POST['act']) && $_POST['act'] == "login") {


    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

        $q = "SELECT * FROM users WHERE email='" . $_POST["email"] . "' AND password='" . encrypt($_POST["password"]) . "'";

        $result = mysqli_query($mysqli, $q);
        if ($result->num_rows === 1) {
            foreach ($result as $rows) {
                // session_start();
                $_SESSION["id"] = $rows["id"];
                $_SESSION["email"] = $rows["email"];
                // $id = $_SESSION["id"];
                // $email = $_SESSION["email"];
            }
            echo "success";
        } else {
            echo "error";
        }
    }
} elseif (isset($_POST['act']) && $_POST['act'] == "createLink") {
    $email = $_SESSION['email'];
    createLink($email, false, '');
} elseif (isset($_POST['act']) && $_POST['act'] == "updateProfile") {

    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $q = 'UPDATE users SET name="' . $name . '",email="' . $email . '",phone="' . $phone . '" WHERE id="' . $id . '"';

        $result = mysqli_query($mysqli, $q);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }
} elseif (isset($_POST['act']) && $_POST['act'] == "adminlogin") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

        $q = "SELECT * FROM admin WHERE email='" . $_POST["email"] . "' AND password='" . encrypt($_POST["password"]) . "'";

        $result = mysqli_query($mysqli, $q);
        if ($result->num_rows === 1) {
            foreach ($result as $rows) {
                // session_start();
                $_SESSION["admin_id"] = $rows["id"];
                $_SESSION["admin_email"] = $rows["email"];
                // $id = $_SESSION["id"];
                // $email = $_SESSION["email"];
            }
            echo "success";
        } else {
            echo "error";
        }
    }
} elseif (isset($_POST['act']) && $_POST['act'] == "logout") {

    unset($_SESSION["id"]);
    unset($_SESSION["email"]);
    // $destroyed = session_destroy();
    if (empty($_SESSION['id']) && empty($_SESSION['email'])) echo "success";
    else echo "error";
} elseif (isset($_POST['act']) && $_POST['act'] == "adminlogout") {

    unset($_SESSION["admin_id"]);
    unset($_SESSION["admin_email"]);
    // $destroyed = session_destroy();
    if (empty($_SESSION['id']) && empty($_SESSION['email'])) echo "success";
    else echo "error";
}

// if (!empty($_POST["full_name"]) && !empty($_POST["enquiryEmail"]) && !empty($_POST["contactNumber"]) && !empty($_POST["enquiryDetail"]) && isset($_FILES["uploadImage"])) {
if (!empty($_POST["full_name"]) && !empty($_POST["enquiryEmail"]) && !empty($_POST["contactNumber"]) && !empty($_POST["enquiryDetail"])) {

    // $image = $_FILES["uploadImage"]['name'];
    // $targetPath = "./patterns/" . basename($image);
    // $moved = move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetPath);

    $fullname = $_POST["full_name"];
    $email = $_POST["enquiryEmail"];
    $phone = $_POST["contactNumber"];
    $detail = $_POST["enquiryDetail"];
    // print_r($_POST);
    // exit;

    // $q = "INSERT INTO orders(fullname,email,phone,image,enquirydetail,userid)
    //     VALUES ('" . $fullname . "','" . $email . "','" . $phone . "','" . $image . "','" . $detail . "','" . $_SESSION['id'] . "' ) ";

    $q = "INSERT INTO orders(fullname,email,phone,image,enquirydetail,designUrl,userid)
        VALUES ('" . $fullname . "','" . $email . "','" . $phone . "','','" . $detail . "','',1 ) ";

    $result = mysqli_query($mysqli, $q);
    $orderlastId = $mysqli->insert_id;
    // if ($result && $moved) {
    if ($result) {
        createLink($email, true, $orderlastId);
        // echo "success";
    } else {
        echo "error";
    }
}

// if (!empty($_POST["full_name"]) && !empty($_POST["enquiryEmail"]) && !empty($_POST["contactNumber"]) && !empty($_POST["enquiryDetail"]) && isset($_FILES["uploadImage"])) {

//     $image = $_FILES["uploadImage"]['name'];
//     $targetPath = "./patterns/" . basename($image);
//     $moved = move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetPath);

//     $fullname = $_POST["full_name"];
//     $email = $_POST["enquiryEmail"];
//     $phone = $_POST["contactNumber"];
//     $detail = $_POST["enquiryDetail"];

//     $q = "INSERT INTO orders(fullname,email,phone,image,enquirydetail,userid)
//         VALUES ('" . $fullname . "','" . $email . "','" . $phone . "','" . $image . "','" . $detail . "','" . $_SESSION['id'] . "' ) ";

//     $result = mysqli_query($mysqli, $q);

//     if ($result && $moved) {
//         echo "success";
//     } else {
//         echo "error";
//     }
// }

if (isset($_FILES["uploadModelImg"])) {

    $valid_extensions = array('png');
    $ext = strtolower(pathinfo($_FILES['uploadModelImg']['name'], PATHINFO_EXTENSION));

    if (in_array($ext, $valid_extensions)) {

        $image = strtolower(pathinfo($_FILES["uploadModelImg"]['name']));
        $i = countFiles("./patterns/A/");
        $image = "pattern-" . ++$i . "a." . $image['extension'];
        $targetPath = "./patterns/A/" . basename($image);
        $moved = move_uploaded_file($_FILES['uploadModelImg']['tmp_name'], $targetPath);

        // $q = "INSERT INTO orders(fullname,email,phone,image,enquirydetail)
        //     VALUES ('" . $fullname . "','" . $email . "','" . $phone . "','" . $image . "','" . $detail . "' ) ";

        // $result = mysqli_query($mysqli, $q);
        echo '{ "result" : "success", "info":"Model Uploaded!" }';
    } else {
        echo '{ "result" : "Error", "info":"Invalid File Type!" }';
    }
}


// UPLOADING FOAM DESIGN HANDLING
if (isset($_FILES) && !empty($_FILES)) {
    if ($_GET['act'] == "uploadDesignA") {
        $valid_extensions = array('png');
        // valid extensions

        // get uploaded file's extension
        $ext = strtolower(pathinfo($_FILES['designA']['name'], PATHINFO_EXTENSION));

        // check's valid format
        if (in_array($ext, $valid_extensions)) {

            // counting files in folder
            $i = countFiles("./patterns/A/");
            // giving desired name to file 
            $designA =  "pattern-" . ++$i . "a." . $ext;

            //Move uploaded file to a nice directory
            $targetPath = "./patterns/A/" . basename($designA);
            $saved = move_uploaded_file($_FILES['designA']['tmp_name'], $targetPath);
            if ($saved) {
                echo '{ "result" : "Uploaded", "status":"200" }';
            }
        } else {
            echo '{ "result" : "Error" }';
        }
    } elseif ($_GET['act'] == "uploadDesignB") {
        $valid_extensions = array('png');
        // valid extensions
        // print_r($_FILES);

        // get uploaded file's extension
        $ext = strtolower(pathinfo($_FILES['designB']['name'], PATHINFO_EXTENSION));

        // check's valid format
        if (in_array($ext, $valid_extensions)) {

            // counting files in folder
            $i = countFiles("./patterns/B/");
            // giving desired name to file 
            $designB =  "pattern-" . ++$i . "b." . $ext;

            //Move uploaded file to a nice directory
            $targetPath = "./patterns/B/" . basename($designB);
            $saved = move_uploaded_file($_FILES['designB']['tmp_name'], $targetPath);
            if ($saved) {
                echo '{ "result" : "Uploaded", "status":"200" }';
            }
        } else {
            echo '{ "result" : "Error" }';
        }
    }
}

// $totalFiles = countFiles("patterns2/A/");
// $fileNameA = getFileNames("patterns2/A/");
// $fileNameB = getFileNames("patterns2/B/");

// $totalFiles = countFiles("patterns/A/");
// $fileNameA = getFileNames("patterns/A/");
// $fileNameB = getFileNames("patterns/B/");

// $totalFiles = countFiles("wood pattern/");
// $fileNameA = getFileNames("wood pattern/");
// $j = 57;
// $k = 1;
// for ($i = 0; $i < $totalFiles; $i++) {
//     // $q = "INSERT INTO pattern120(name,url_A,url_B)
//     // VALUES('Foam {$j}','patterns2/A/{$j}a.png','patterns2/B/{$j}b.png')";
//     $q = "INSERT INTO pattern60(name,url_A,url_B)
//     VALUES('Foam {$j}','wood pattern/{$k}.png','wood pattern/{$k}.png');";
//     // $res = mysqli_query($mysqli, $q);
//     // var_dump($res);
//     echo "<br>" . $q . "<br>";
//     $j++;
//     $k++;
// }
// exit;