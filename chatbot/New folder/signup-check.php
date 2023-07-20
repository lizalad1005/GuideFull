<?php
session_start();
include "db_conn.php";


if (
    isset($_POST['username']) && isset($_POST['password'])
    && isset($_POST['emailAdress']) && isset($_POST['phone'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $phone = validate($_POST['phone']);
    $emailAdress = validate($_POST['emailAdress']);

    $user_data = 'username=' . $username . '&emailAdress=' . $emailAdress;


    if (empty($username)) {
        header("Location: index.html?error=User Name is required&$user_data");
        exit();
    } else if (empty($password)) {
        header("Location: index.html?error=Password is required&$user_data");
        exit();
    } else if (empty($phone)) {
        header("Location: index.html?error=Re Password is required&$user_data");
        exit();
    } else if (empty($emailAdress)) {
        header("Location: index.html?error=emailAdress is required&$user_data");
        exit();
    } 
    } else {

        // hashing the password
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE user_name='$username' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: index.html?error=The username is taken try another&$user_data");
            exit();
        } else {
            $sql2 = "INSERT INTO users(user_name, password, emailAdress) VALUES('$username', '$password', '$emailAdress')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: home.html");
                exit();
            } else {
                header("Location: index.html?error=unknown error occurred&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: index.html");
    exit();
}
