<?php
class Despesa {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=desenrolai',
            'root',
            ''
        );
    }

    public function cadastrar($descricao, $valor, $data, $categoria, $usuario_id) {
        $sql = "INSERT INTO despesa (DESCRICAO, VALOR, DATAS, CATEGORIA, USUARIO_ID)
                VALUES (:descricao, :valor, :data, :categoria, :usuario_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':data' => $data,
            ':categoria' => $categoria,
            ':usuario_id' => $usuario_id
        ]);
    }

    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT * FROM despesa WHERE USUARIO_ID = :usuario_id ORDER BY DATAS DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
