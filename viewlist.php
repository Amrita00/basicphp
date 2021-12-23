<?php
include('function.php');
session_start();
if (!$_SESSION['uname']) {
    header('Location: loginform.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" style="margin-left: 5px;">Simple Registration Form</a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-right: 20px; margin-top:15px; font-weight:bold;"><?php echo "Welcome " .$_SESSION['uname'] ?></li>
                <li><button class="btn btn-info navbar-btn" style="margin-right: 20px;" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-log-out"></span> Log Out</button></li>
            </ul>
        </div>
    </nav>
    <table class="table table-striped" id="table">
        <thread>
            <tr>
                <th colspan="5">
                    <h3>List of Users</h3>
                </th>
            </tr>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of birth</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
        </thread>
        <?php
        $connection = new DBfunction();
        $row = $connection->getuser();
        foreach ($row as $rows) {
            echo '
                    <tr>
                        <td>' . $rows['firstname'] . '</td>
                        <td>' . $rows['lastname'] . '</td>
                        <td>' . $rows['dob'] . '</td>
                        <td>' . $rows['email'] . '</td>
                        <td>' . $rows['pnumber'] . '</td>
                    </tr>
                ';
        }
        ?>
    </table>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>