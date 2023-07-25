<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log("jQuery loaded");
            $("#btnSignUP").click(function () {
                //console.log("button clicked");

                $.ajax({
                    url: `<?php echo e(url('/users/signup')); ?>`,
                    method: "POST",
                    data: {
                        name : $("#uname").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        pass1: $("#pass1").val(),
                        pass1_confirmation: $("#pass2").val(),
                    },
                    success: function (data, status) {
                        if (status == "success") {
                            if (data.message == "success")
                                alert("User Signup Successfully Completed");
                            else alert("Something went wrong");
                        }
                        //  console.log(data);
                    },
                    error: function (error) {
                        console.log(error);
                    },

                    // error: function (error) {
                    //     var errors = JSON.parse(error.responseText).errors;
                    //     console.log(errors);
                    //     //alert(errors);
                    //     // Update the error message
                    //     if (errors.hasOwnProperty('name')) {
                    //         var nameError = errors.name[0];
                    //         $("#errorName").text(nameError);
                    //     } else $("#errorName").text("");
                    //     if (errors.hasOwnProperty('phone')) {
                    //         var phoneError = errors.phone[0];
                    //         $("#errorPhone").text(phoneError);
                    //     } else $("#errorPhone").text("");
                    //     if (errors.hasOwnProperty('email')) {
                    //         var emailError = errors.email[0];
                    //         $("#errorEmail").text(emailError);
                    //     } else $("#errorEmail").text("");

                    //     if (errors.hasOwnProperty('pass1')) {
                    //         //  var pass1Error = errors.pass1[0];
                    //         $("#errorPass1").text('Password must contain atlease one upper case, one lower case, one digit and one special character');
                    //     } else {
                    //         $("#errorPass1").text('');
                    //     }
                    //     if (errors.hasOwnProperty('pass1_confirmation')) {
                    //         // var pass1Error = errors.pass1_confirmation[0];t
                    //         $("#errorPass2").text('Password and Confirm Password must be the same!');
                    //     } else $("#errorPass2").text("");
                    // },
                });
            });

            $("#btnLogin").click(function () {
                var email = $("#emailUser").val();
                var pass1 = $("#passW").val();

                $.ajax({
                    url: `<?php echo e(url('/users/signin')); ?>`,
                    method: "POST",
                    data: { email: email, pass1: pass1 },
                    success: function (data, status) {
                        if (status == "success") {
                            if (data.message == "success") {
                                window.location.href = "<?php echo e(url("/")); ?>";
                            } else {
                                alert(data.message);
                            }
                        }
                    },
                    error: function (error) {
                        var errorMessage = error.responseText;
                        console.log(errorMessage);
                        $("#errorContainer").text(errorMessage);
                    },
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 border-right">
                <header class="modal-header">
                    <h4>SignUP:</h4>
                </header>
                <div class="form-group">
                    <label>Name :</label>
                    <input type="text" name="uname" id="uname" value="<?php echo e(old('uname')); ?>" class="form-control" />
                    <span id="errorName" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="number" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" class="form-control" />
                    <span id="errorPhone" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control" />
                    <span id="errorEmail" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="pass1" id="pass1" class="form-control" />
                    <span id="errorPass1" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" name="pass2" id="pass2" class="form-control" />
                    <span id="errorPass2" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <button type="button" id="btnSignUP" class="btn btn-sm btn-outline-primary">Submit</button>
                </div>
            </div>
            <div class="col-lg-6">
                <header class="modal-header">
                    <h4>SignIN:</h4>
                </header>
                <div class="form-group">
                    <label>Email :</label>
                    <input type="text" name="emailUser" id="emailUser" value="<?php echo e(old('email')); ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="passW" id="passW" class="form-control" />
                </div>
                <div class="form-group">
                    <button id="btnLogin" class="btn btn-sm btn-outline-danger" type="button">Login</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\laravel\myApp\resources\views/users/userpage.blade.php ENDPATH**/ ?>