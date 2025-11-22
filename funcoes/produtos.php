<?php
class Produto
{
    public function __construct(protected PDO $pdo) {}
    
    public function adicionar_produto($nome, $quantidade, $categoria) {
        try {
        $stmt_checar = $this->pdo->prepare("SELECT COUNT(*) FROM produto WHERE nome = :nome");
        $stmt_checar->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt_checar->execute();
        $contador = $stmt_checar->fetchColumn();
        if ($contador > 0) {
            //produto já existe
            return 3;
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO produto (nome, quantidade, categoria_id) VALUES (?, ?, ?)");
            if ($stmt->execute([$nome, $quantidade, $categoria])) {
                //produto adicionado com sucesso
                return 1;
            }
            return 2;
        }
    } catch (Exception $e) {
        echo ("Ocorreu um erro ao adicionar um novo produto: " . $e->getMessage());
        return 2;
    }
    }
    public function recuperar_produtos()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM produto ORDER BY nome");
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
