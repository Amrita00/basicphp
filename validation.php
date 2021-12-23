<?php


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$pnumber = $_POST['pnumber'];
$username = $_POST['username'];
$password = $_POST['password'];

$errors = [];
$data = [];

if (empty($fname)) {
    $errors['fname'] = 'First name is required';
}

if (empty($lname)) {
    $errors['lname'] = 'Last name is required';
}

if (empty($dob)) {
    $errors['dob'] = 'Date of birth is required';
}

if (empty($email)) {
    $errors['email'] = 'Email is required';
}

if (empty($pnumber)) {
    $errors['pnumber'] = 'Number is required';
}

if (empty($username)) {
    $errors['username'] = 'Username is required';
}

if (empty($password)) {
    $errors['password'] = 'Password is required';
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    
    include 'function.php';
    $connection = new DBfunction();
    $success = $connection->registration($fname, $lname, date("Y-m-d", strtotime($dob)), $email, $number, $username, md5($password));
    
    $data['success'] = true;
    $data['message'] = 'Success!';
}

echo json_encode($data);
