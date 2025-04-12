<?php

class RelatorioModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=desenrolai',
            'root',
            ''
        );
    }

    public function getTotaisMensaisPorAno($ano) {
        $query = "
            SELECT 
                MONTH(DATAS) AS mes,
                SUM(VALOR) AS total_mes
            FROM despesa
            WHERE YEAR(DATAS) = :ano
            GROUP BY mes
            ORDER BY mes
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totais = array_fill(1, 12, 0);
        foreach ($result as $row) {
            $totais[intval($row['mes'])] = floatval($row['total_mes']);
        }

        return $totais;
    }

    public function getAnosDisponiveis() {
        $query = "SELECT DISTINCT YEAR(DATAS) AS ano FROM despesa ORDER BY ano DESC";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

?>
