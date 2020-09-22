<?php

include './config/auth.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SPK Duta Budaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="./assets/img/logo-2.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="./assets/css/propeller.min.css">

    <link rel="stylesheet" type="text/css" href="./assets/themes/css/propeller-theme.css" />

    <link rel="stylesheet" type="text/css" href="./assets/themes/css/propeller-admin.css">

    <style>
    	body {
            background-image: url('./assets/img/bge-img.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
    		background-color: rgba(0,0,0,0.3);
    	}
    </style>
</head>
<body class="body-custom">
	<div class="logincard">
        <div class="alert alert-success"> Oh snap! Change a few things up and try submitting again. </div>
        <div class="pmd-card card-default pmd-z-depth">
            <div class="login-card">
                <form action="./login.php" method="POST" id="loginForm">
                    <div class="pmd-card-title card-header-border text-center">
                        
                        
                        <img src="./assets/img/logo-2.png" height="130" alt="Logo">
                    </div>
                    <center><caption form><b style="color:#A52A2A;font-family:Lucida Calligraphy;font-size:11pt">SPK Pemilihan Duta Budaya<p> Kota Palembang</b><br></caption></center>

                    <div class="pmd-card-body">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inputError1" class="control-label pmd-input-group-label">Nama Pengguna</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">perm_identity</i></div>
                                <input type="text" name="username" class="form-control" id="loginNim">
                            </div>
                        </div>
                        
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="inputError1" class="control-label pmd-input-group-label">Kata Sandi</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">lock_outline</i></div>
                                <input type="password" name="password" class="form-control" id="passwordLogin">
                            </div>
                        </div>
                    </div>
                    <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">
                        <div class="form-group clearfix">
                            <div class="checkbox pull-left">
                                <label class="pmd-checkbox checkbox-pmd-ripple-effect">
                                    <input type="checkbox" checked id="rm">
                                    <span class="pmd-checkbox"> Ingat Saya</span>
                                </label>
                            </div>
                        </div>
                        <input type="submit" class="btn pmd-ripple-effect btn-primary btn-block" name="login" value="login">
                        
                        <p class="redirection-link">Belum punya akun? <a href="javascript:void(0);" class="login-register">Daftar Sekarang</a>.</p>
                        
                    </div>  
                </form>
            </div>

            <div class="register-card">
                <form action="./register.php" method="POST">  
                    <div class="pmd-card-title card-header-border text-center">
                        <div class="loginlogo">
                            <img src="./assets/img/logo-2.png" alt="Logo" height="150">
                        </div>
                    </div>
                    <div class="pmd-card-body">
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="inputError1" class="control-label pmd-input-group-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">mail</i></div>
                                    <input type="email" name="email" class="form-control" id="loginNim">
                                </div>
                            </div>

                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="inputError1" class="control-label pmd-input-group-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">perm_identity</i></div>
                                    <input type="text" name="nama" class="form-control" id="loginNim">
                                </div>
                            </div>
                            
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="inputError1" class="control-label pmd-input-group-label">Kata Sandi</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">lock_outline</i></div>
                                    <input type="password" name="password" class="form-control" id="passwordLogin">
                                </div>
                            </div>

                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label for="inputError1" class="control-label pmd-input-group-label">Ulang Kata Sandi</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">lock_outline</i></div>
                                    <input type="password" name="re-password" class="form-control" id="passwordLogin">
                                </div>
                            </div>
                    </div>
                      
                    <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">
                        <button type="submit" class="btn pmd-ripple-effect btn-primary btn-block">Daftar</button>
                        <p class="redirection-link">Sudah punya akun? <a href="javascript:void(0);" class="register-login">Masuk</a>. </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<script src="./assets/js/jquery-1.12.2.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/propeller.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                $(".login-register").click(function(){
                    $('.login-card').hide()
                    $('.register-card').show();
                });
                
                $(".register-login").click(function(){
                    $('.register-card').hide()
                    $('.login-card').show();
                }); 
        });
    </script>
</body>
</html>