<?php
class UsuarioModel {
    private $pdo;

    public function __construct() {
        // Conexão direta (simplificada)
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=desenrola',
            'root',          // Seu usuário MySQL
            ''               // Sua senha MySQL
        );
    }

    public function cadastrar($nome, $email, $senha) {
        $sql = "INSERT INTO usuario (NOME, EMAIL, SENHA) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha]);
        
        // Retorna o ID do novo usuário
        return $this->pdo->lastInsertId();
    }
    
    public function login($email, $senha) {
        $sql = "SELECT ID_USUARIO, NOME, SENHA FROM usuario WHERE EMAIL = ? AND SENHA = ?"; // ← Comparação direta
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $senha]); // ← Envia a senha em texto puro
        return $stmt->fetch(); // Retorna o usuário se encontrado
    }
}
?>