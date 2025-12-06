<?php

require_once __DIR__ . '/../config/Conexion.php';

class Usuario
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function login($email, $password_hash)
    {

        try {
            $sql = "select * from usuario where email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() != 1) {
                $password = '';
                foreach ($stmt->fetchAll() as $resultado) {
                    $password = $resultado['password_hash'];
                }

                if (password_verify($password_hash, $password)) {
                    echo 'Exito';
                    return true;
                } else {
                    print 'El usuario y/o contraseña no coinciden.';
                    return false;
                }
            } else {
                print 'El usuario y/o contraseña no coinciden.';
                return false;
            }

        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    public function register($nombre_completo, $email, $password_hash)
    {

        try {
            $sql = "insert into usuario(nombre_completo, email, password_hash) values (:nombre, :email, :contrasena)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre_completo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contrasena', $password_hash);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
}
