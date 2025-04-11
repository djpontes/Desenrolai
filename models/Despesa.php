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

    public function deletar($id) {
        $sql = "DELETE FROM despesa WHERE ID_DESPESA = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listarPorUsuarioFiltrado($usuarioId, $mes, $ano) {
        $sql = "SELECT * FROM despesas 
                WHERE ID_USUARIO = :usuario_id 
                  AND MONTH(DATAS) = :mes 
                  AND YEAR(DATAS) = :ano 
                ORDER BY DATAS DESC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorMesEAno($usuario_id, $mes, $ano) {
        $sql = "SELECT * FROM despesa 
                WHERE USUARIO_ID = :usuario_id 
                  AND MONTH(DATAS) = :mes 
                  AND YEAR(DATAS) = :ano 
                ORDER BY DATAS DESC";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar($id, $descricao, $valor, $data, $categoria) {
        $sql = "UPDATE despesa SET DESCRICAO = :descricao, VALOR = :valor, DATAS = :data, CATEGORIA = :categoria WHERE ID_DESPESA = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':data' => $data,
            ':categoria' => $categoria
        ]);
    }

}
?>
