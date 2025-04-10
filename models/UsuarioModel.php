<?php
class UsuarioModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=desenrolai',
            'root',
            ''
        );
    }

    public function cadastrar($nome, $email, $senha) {
        $sql = "INSERT INTO usuario (NOME, EMAIL, SENHA) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha]);
        return $this->pdo->lastInsertId();
    }

    public function login($email, $senha) {
        $sql = "SELECT ID_USUARIO, NOME, EMAIL, SENHA FROM usuario WHERE EMAIL = ? AND SENHA = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $senha]);
        return $stmt->fetch();
    }

    public function atualizarUsuario($id, $nome, $email, $senha = null) {
        try {
            if ($senha !== null) {
                $stmt = $this->pdo->prepare("UPDATE usuario SET NOME = ?, EMAIL = ?, SENHA = ? WHERE ID_USUARIO = ?");
                $stmt->execute([$nome, $email, $senha, $id]);
            } else {
                $stmt = $this->pdo->prepare("UPDATE usuario SET NOME = ?, EMAIL = ? WHERE ID_USUARIO = ?");
                $stmt->execute([$nome, $email, $id]);
            }
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>
