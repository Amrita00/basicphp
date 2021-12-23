<?php
session_start();
include('function.php');

$connection = new DBfunction();
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
 
    if (!empty($username) && !empty($password)) {

        $login = $connection->login($username, $password);

        if ($login) {
            $_SESSION['uid'] = $login['id'];
            $_SESSION['uname'] = $username;

            header("Location: viewlist.php");
        } else {
           header("Location: loginform.php");
        }
    }
}
