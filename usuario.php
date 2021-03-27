<?php

include_once 'conexion.php';
$pdo = new Conexion();

class usuario
{
    private $IdUsuario;
    private $nombreUsuario;
    private $usuario;
    private $password;
    private $foto;
    private $privilegios;

    public function getIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function setIdUsuario($IdUsuario)
    {
        $this->IdUsuario = $IdUsuario;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getPrivilegios()
    {
        return $this->privilegios;
    }

    public function setPrivilegios($privilegios)
    {
        $this->privilegios = $privilegios;
    }

    function usuarioAlta()
    {

        try {

            $pdo = new Conexion();
            $query2 = $pdo->prepare("SELECT * FROM usuario WHERE usuario= :usuario");
            $query2->bindValue(':usuario', $this->getUsuario());
            $query2->execute();
            $resultado = $query2->fetchAll();

            if (!$resultado) {

                /*
                $query = $pdo->prepare("INSERT INTO usuario ("
                    . " nombreUsuario, usuario, password, privilegios) values("
                    . " :nombreUsuario, :usuario, :password, :privilegios);");
                $query->bindValue(':nombreUsuario', $this->getNombreUsuario());
                $query->bindValue(':usuario', $this->getUsuario());
                $query->bindValue(':password', $this->getPassword());
                $query->bindValue(':privilegios', $this->getPrivilegios());
                $query->execute();
                */

                $query = $pdo->prepare("INSERT INTO usuario ("
                    . " nombreUsuario, usuario, password,foto, privilegios) values("
                    . " :nombreUsuario, :usuario, :password, :foto, :privilegios);");
                $query->bindValue(':nombreUsuario', $this->getNombreUsuario());
                $query->bindValue(':usuario', $this->getUsuario());
                $query->bindValue(':password', $this->getPassword());
                $query->bindValue(':foto', $this->getFoto());
                $query->bindValue(':privilegios', $this->getPrivilegios());
                $query->execute();
                $_SESSION['message'] = 'Now you can sign in';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'User already exists. Try again';
                $_SESSION['message_type'] = 'danger';
                echo '<script>location.href="login.php"</script>';
            }

        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }

        $pdo = null;

    }
}

