<?php
include_once 'conexion.php';
$pdo = new Conexion();
//session_start();
//print_r($_POST);
//variables que pasamos del formulario de IndexLogin
$usuario = $_POST['usuario'];
$password = $_POST['password'];


//Conexion a base de datos
if ($usuario == '' || $password == '') {
    header('location: login.php');
} else {
    try {
        $query = $pdo->prepare("SELECT * FROM usuario WHERE usuario= :username");
        $query->bindValue(':username', $usuario);
        $query->execute();
        $resultado = $query->fetchAll();

        if (!$resultado) {
            $_SESSION['message'] = 'User or password are incorrect. Try again';
            $_SESSION['message_type'] = 'danger';
            echo '<script>location.href="login.php"</script>';
        } else {

            foreach ($resultado as $value) {
                echo "si existe el usuario";
                if (password_verify($password, $value['password'])) {
                    $_SESSION['valido'] = 1;
                    $_SESSION['IdUsuario'] = $value['id'];
                    $_SESSION['nombreUsuario'] = $value['nombreUsuario'];
                    $_SESSION['foto'] = $value['foto'];
                    $_SESSION['privilegios'] = $value['privilegios'];

                    if (isset($_SESSION['direccionURL'])) {
                        echo "<script>location.href='" . $_SESSION['direccionURL'] . "'</script>";
                    } else {

                        header('location: index.php');
                    }

                } else {
                    $_SESSION['message'] = 'User or password are incorrect. Try again';
                    $_SESSION['message_type'] = 'danger';
                    //echo '<script>alert("El usuario o contraseña son incorrectos. Intente de nuevo.")</script>';
                    echo '<script>location.href="login.php"</script>';
                }
            }///Fin del foreach
        }


    } catch (PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }
    $pdo = null;

}
