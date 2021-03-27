<?php
include_once 'conexion.php';
$pdo = new Conexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>

    <script
            src="https://kit.fontawesome.com/64d58efce2.js"
            crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="login.css"/>

    <title>CONSUVINO</title>
</head>
<body>

<div class="container1">

    <div class="forms-container">
        <div class="signin-signup">
            <!-- Login-->
            <form id="loginform" class="sign-in-form" role="form" method="post" action="loginValidar.php">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php session_unset();
                } ?>
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="login-username" type="text" class="form-control" name="usuario" value=""
                           placeholder="Email"/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="login-password" type="password" class="form-control" name="password"
                           placeholder="password"/>
                </div>
                <div class="input-groupp">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                        </label>
                    </div>
                </div>
                <!-- Button login-->
                <div class="coll-sm-12 controls">
                    <button id="btn-signup" type="submit" class="btn btn-info" name="usuarioVerificar"><i
                                class="icon-hand-center"></i> &nbsp Login
                    </button>
                </div>
            </form>
            <!-- Sign up-->
            <form id="signupform" class="sign-up-form" role="form" action="aplicarMovimiento.php" method="post"
                  enctype="multipart/form-data">
                <h2 class="title">Sign up</h2>
                <!-- subir imagen start -->
                <div class="">
                    <i class="fas fa-user"></i>
                    <label>Seleccione foto de usuario</label>
                </div>
                <div class="">
                    <input type="file" name="foto" required>
                </div>
                <!-- subir imagen end -->
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" class="form-control" name="usuario" placeholder="Email Address" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <!-- Button sign up-->
                <button id="btn-signup" type="submit" class="btn btn-info" name="usuarioAlta"><i
                            class="icon-hand-right"></i> &nbsp Sign up
                </button>
            </form>

        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here ?</h3>
                <p> Sign up to be able to use our system </p>
                <button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button>
            </div>
            <img src="img/log.svg" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p> Login to start using our system </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="img/register.svg" class="image" alt=""/>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
        crossorigin="anonymous"></script>

<script src="login.js"></script>
</body>
</html>