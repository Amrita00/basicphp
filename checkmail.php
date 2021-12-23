<?php
include('function.php');

if (isset($_POST['cemail'])) {
    $connection = new DBfunction();
    $mailcheck = $connection->emailfree($_POST['cemail']);
    
    echo $mailcheck;
}
                      