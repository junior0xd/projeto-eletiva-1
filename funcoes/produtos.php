<?php
class Produto
{
    private PDO $pdo; 

    public function __construct(PDO $db) {
        $this->pdo = $db;
    }
    
    public function recuperar_produtos()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM produto");
            $produtos = $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Erro ao recuperar informações: " . $e->getMessage();
        }
        return $produtos;
    }

    public function recuperar_categorias()
    {
        try {
            $stmt = $this->pdo->query("SELECT * from categoria");
            $categorias = $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Erro ao recuperar informações: " . $e->getMessage();
        }
        return $categorias;
    }
}
