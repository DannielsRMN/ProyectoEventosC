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

    public function listar()
    {
        try {
            $sql = 'SELECT * FROM usuario';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtener($id)
    {
        try {
            $sql = 'SELECT * FROM usuario WHERE id_usuario = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerPorEmail($email) {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($password == $usuario['password_hash']) {
                    return $usuario;
                }
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>