<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeus | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="margin-top: 150px;">
                
                <div class="mb-3">
                    <h1 class="font-weight-bold">Sign In</h1>
                </div>

                <div class="d-none" id="msg">
                    <p class="text-white fw-bold" id="err"></p>
                </div>
                    

                    <?php

                        $email = "";
                        $password = "";

                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }

                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }

                    ?>

                    <div class="mb-2">
                        <label class="col-form-label font-weight-bold">Username</label>
                        <input class="form-control font-weight-bold" type="email" id="uname" placeholder="Enter your email." value="<?php echo $email; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label font-weight-bold">Password</label>
                        <input class="form-control font-weight-bold" type="Password" id="pass" placeholder="Enter your passwordc." value="<?php echo $password; ?>">
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <div class="mb-3 mt-3 gap-3">
                            <input type="checkbox" id="check">
                            <label>Remember me.</label>
                        </div>
                        <a href="#" class="mt-3" onclick="forgotPassword()">Forgot Password</a>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary col-12 font-weight-bold" type="submit" onclick="signIn();">Sign In</button>
                        <p class="fw-bold text-center mt-3">Don't have an account.<a href="signUp.php">Click here.</a></p>
                    </div>
            </div>

            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">

                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="npi" />
                                            <button class="btn btn-outline-secondary" type="button" id="npb" onclick="ShowPassword();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="rnp" />
                                            <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="ShowPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Verification Code</label>
                                        <input type="text" class="form-control" id="vc" />
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <!-- footer -->
    <?php require 'footer.php'; ?>
    <!-- footer -->

    <script src="script.js"></script>
</body>
</html>