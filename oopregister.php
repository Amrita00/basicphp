<?php
include('function.php');

$connection = new DBfunction();
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = date("Y-m-d", strtotime($_POST['dob']));
    $email = $_POST['email'];
    $number = $_POST['pnumber'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

   
    if (!empty($fname) && !empty($lname) && !empty($dob) && !empty($email) && !empty($number) && !empty($username) && !empty($password)) {

        $success = $connection->registration($fname, $lname, $dob, $email, $number, $username, $password);
        echo $success ? "<script>window.location.href='loginform.php'</script>" : 'Saved failed';
      
        
        //$mailavailable = $connection->emailfree($email);
        //$uname = $connection->usernamefree($uname);
       
        /*if ($mailavailable) {
          
            echo $mailavailable ? 'Email already exists' : 'Email available';

        }elseif($uname){

            echo $uname ? 'Username already exists' : 'Username available';


        } else {

            
            echo $success ? 'Registered Sucessfully' : 'Saved failed';
        }*/
    }
}
