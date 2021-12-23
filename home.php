<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registration Form</title>
    <style>
        .help-block {
            color: red;
            padding-top: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="form">
            <h3>Registration form</h5>
                <hr />
                <form method="POST" id="registerform" onsubmit="return validate()">
                    <p aria-hidden="true" id="required-description">
                        <span class="required">*</span> &nbsp;Required field
                    </p>
                    <div id="fname-group" class="form-group has-error">
                        <label for="fname">First Name</label><span class="required">*</span>
                        <input type="text" name="fname" id="fname" placeholder="Enter your first name" />
                        <span id="availability"></span><br />
                    </div>

                    <div id="lname-group" class="form-group has-error">
                        <label for="lname">Last Name</label><span class="required">*</span>
                        <input type="text" name="lname" id="lname" placeholder="Enter your last name" />
                        <span id="check"></span><br />
                    </div>

                    <div id="dob-group" class="form-group has-error">
                        <label for="dob">Date of birth</label><span class="required">*</span>
                        <input type="date" name="dob" id="dob" placeholder="Enter your date of birth" max="2003-12-31" /><br />
                    </div>
                    <div id="email-group" class="form-group has-error">
                        <label for="email">Email</label><span class="required">*</span>
                        <input type="email" name="email" id="email" placeholder="Enter your email address" /><br />
                        <span class="availability"></span>
                    </div>
                    <div id="number-group" class="form-group has-error">
                        <label for="pnumber">Phone Number</label><span class="required">*</span>
                        <input type="text" name="pnumber" id="pnumber" placeholder="Enter your phone number" /><br />
                    </div>
                    <div id="username-group" class="form-group has-error">
                        <label for="username">Username</label><span class="required">*</span>
                        <input type="text" name="username" id="username" placeholder="Enter your Username" /><br />
                    </div>
                    <div id="password-group" class="form-group has-error">
                        <label for="password">Password</label><span class="required">*</span>
                        <input type="password" name="password" id="password" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /><br />
                        <div id="message" class="message">
                            <h7>Password must contain the following:</h7>
                            <span id="letter" class="invalid">A <b>lowercase</b> letter</span><br />
                            <span id="capital" class="invalid">A <b>capital (uppercase)</b> letter</span><br />
                            <span id="number" class="invalid">A <b>number</b></span><br />
                            <span id="length" class="invalid">Minimum <b>8 characters</b></span><br />
                        </div>
                    </div>
                    <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success"><br /><br />
                    <a href="viewlist.php" class="btn btn-info">View list of users</a>

                </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- <script>
        $(document).ready(function() {
        
        });
    </script> -->
    <script>
        $(document).ready(function() {

            $("form").submit(function(event) {
                var formData = {
                    firstname: $("#fname").val(),
                    lastname: $("#lname").val(),
                    dob: $("#dob").val(),
                    email: $("#email").val(),
                    pnumber: $("#pnumber").val(),
                    username: $("#username").val(),
                    password: $("#password").val()
                };

                $.ajax({
                    type: "POST",
                    url: "validation.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);

                    if (!data.success) {
                        if (data.errors.fname) {
                            $("#fname-group").addClass("has-error");
                            $("#fname-group").append(
                                '<div class="help-block">' + data.errors.fname + "</div>"
                            );
                        }
                        if (data.errors.lname) {
                            $("#lname-group").addClass("has-error");
                            $("#lname-group").append(
                                '<div class="help-block">' + data.errors.lname + "</div>"
                            );
                        }
                        if (data.errors.dob) {
                            $("#dob-group").addClass("has-error");
                            $("#dob-group").append(
                                '<div class="help-block">' + data.errors.dob + "</div>"
                            );
                        }
                        if (data.errors.email) {
                            $("#email-group").addClass("has-error");
                            $("#email-group").append(
                                '<div class="help-block">' + data.errors.email + "</div>"
                            );
                        }
                        if (data.errors.pnumber) {
                            $("#number-group").addClass("has-error");
                            $("#number-group").append(
                                '<div class="help-block">' + data.errors.pnumber + "</div>"
                            );
                        }

                        if (data.errors.username) {
                            $("#username-group").addClass("has-error");
                            $("#username-group").append(
                                '<div class="help-block">' + data.errors.username + "</div>"
                            );
                        }

                        if (data.errors.password) {
                            $("#password-group").addClass("has-error");
                            $("#password-group").append(
                                '<div class="help-block">' + data.errors.password + "</div>"
                            );
                        }

                    } else {
                        $("form").html(
                            '<div class="alert alert-success">' + data.message + "</div>"
                        );
                    }

                });

                event.preventDefault();
            });
        });


        $('#email').keyup(function() {

        var email = $('#email').val();

        $.ajax({
            type: "POST",
            url: "checkmail.php",
            dataType: "json",
            data: {
                'submitbutton': 1,
                'cemail': email,
            },
            success: function(data) {
                console.log(data);
                if ("error" == data.status) {
                    $('.availability').css("color", "red");

                } else {
                    $('.availability').css("color", "green");
                }
                $('.availability').html(data.message + "\n");

            }
        })

        });
       
    </script>

    <script>
        var password = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        password.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        password.onblur = function() {
            document.getElementById("message").style.display = "none";
        }


        password.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (password.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (password.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>


    <script type="text/javascript">
        function validate() {
            /* var name = document.forms["registerform"]["fname"].value;
             if (name == "") {
                 alert("Please enter the name");
                 return false;
             }*/
            var email = document.forms["#registerform"]["#email"].value;
            if (email == "") {
                alert("Please enter the email");
                return false;
            } else {
                var re = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
                var x = re.test(email);
                if (x) {} else {
                    alert("Email address not in correct format");
                    return false;
                }
            }
            var mobile = document.forms["#registerform"]["#pnumber"].value;
            if (mobile == "") {
                alert("Please enter the mobile");
                return false;
            } else {
                var res = /^\(?([5]{1})\)?[ ]?([0-9]{7})$/;
                var y = res.test(mobile);
                if (y) {} else {
                    alert("Phone number not in correct format");
                    return false;
                }
            }

        }
    </script>



</body>

</html>