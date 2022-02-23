<?php
// include_once('./func.php');
global $mysqli;
$mysqli = new mysqli("localhost", "root", "", "fyp");
class main
{
    function check_connection()
    {
        global $mysqli;
        if ($mysqli->connect_error) return false;
        else return true;
    }

    function create($q)
    {
        global $mysqli;
        $conn = $this->check_connection();
        if ($conn) {
            $res = mysqli_query($mysqli, $q);
            if ($res)
                return true;
            else
                return false;
        }
    }

    function read($q)
    {
        global $mysqli;
        $conn = $this->check_connection();
        if ($conn) {
            $res = mysqli_query($mysqli, $q);
            // foreach ($res as $rows) {
            //     return $rows;
            // }
            if ($res->num_rows > 0)
                return $res;
            else
                return false;
        }
    }

    function update($q)
    {
        global $mysqli;
        $conn = $this->check_connection();
        if ($conn) {
            $res = mysqli_query($mysqli, $q);
            if ($res)
                return true;
            else
                return false;
        }
    }

    function delete($q)
    {
        global $mysqli;
        $conn = $this->check_connection();
        if ($conn) {
            $res = mysqli_query($mysqli, $q);
            if ($res)
                return true;
            else
                return false;
        }
    }
}

$obj = new main();

// $res = $obj->create("INSERT INTO users(first_name,last_name,email,CNIC,date_of_birth,gender,password,city,province,status) 
// VALUES('','','','','','','','1','100',1) ");
// $res = $obj->read("SELECT * FROM users");
// $res = $obj->update("UPDATE users SET email='abc@exm.com' WHERE id=6");
// $res = $obj->update("DELETE FROM users WHERE id=6");

// print_r($res);
// echo $res;

// foreach ($res as $row) {
//     echo $row['id'] . "<br>";
//     // echo $row['name'] . "<br>";
//     // echo $row['email'] . "<br>";
//     // echo $row['password'] . "<br>";
//     // echo $row['phone'] . "<br>";
// }
