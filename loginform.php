<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Login Form</title>
</head>

<body>
    <div class="container">
        <div class="form">
            <h3>Login form</h5>
                <hr />

                <form method="POST" id="loginform" action="login.php">
                    <span class="required">*</span> &nbsp;Required field</span><br />

                    <label for="username">Username</label><span class="required">*</span>
                    <input type="text" name="username" id="username" placeholder="Enter your Username" required /><br />

                    <label for="password">Password</label><span class="required">*</span>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required /><br />

                    <input type="submit" value="Login" name="login" id="login" class="btn btn-success"><br /><br />
                    <a href="viewlist.php" class="btn btn-info">View list of users</a>

                </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginform').submit(function() {

                var username = $('#username').val();
                var password = $('#password').val();
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    dataType: "json",
                    data: {
                        'submitbutton': 1,
                        'uname': username,
                        'pwd': password,
                    },
                    success: function(data) {
                        console.log(data);
                        if ("error" == data.status) {
                            $('.invalid').addClass('red');

                        } else {
                            $('.invalid').addClass('green');
                        }
                        $('.invalid').html(data.message);
                    }
                })

            });
        });
    </script>
</body>

</html>