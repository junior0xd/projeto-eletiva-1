<?php
class Produto
{
    public function __construct(protected PDO $pdo) {}
    
    public function adicionar_produto($nome, $quantidade, $categoria, $validade = null) {
        try {
        $stmt_checar = $this->pdo->prepare("SELECT COUNT(*) FROM produto WHERE nome = :nome");
        $stmt_checar->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt_checar->execute();
        $contador = $stmt_checar->fetchColumn();
        if ($contador > 0) {
            //produto já existe
            return 3;
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO produto (nome, quantidade, categoria_id, data_validade) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$nome, $quantidade, $categoria, $validade])) {
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
    public function recuperar_produtos($filtro_tipo, $opcoes = [])
    {
        $produtos = [];
        try {
            $condicoes = [];
            $parametros = [];

            if ($filtro_tipo === 'ENFERMAGEM'){
                $condicoes[] = 'categoria_id = :categoria_id';
                $parametros[':categoria_id'] = 1;
            } elseif ($filtro_tipo === 'ESCRITORIO'){
                $condicoes[] = 'categoria_id = :categoria_id';
                $parametros[':categoria_id'] = 2; 
            }
            //procurar produto
            if(!empty($opcoes['item_procurado'])){
                $condicoes[] = 'nome LIKE :item_procurado';
                $parametros[':item_procurado'] = $opcoes['item_procurado'] . '%';
            }
            //vencidos
            if (!empty($opcoes['vencidos'])) {
                $condicoes[] = 'data_validade < CURDATE()';
            }
            // próximos a vencer
            if (!empty($opcoes['proximos'])) {
                $condicoes[] = 'data_validade BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)';
            }
            // baixo estoque
            if (!empty($opcoes['baixo'])) {
                $condicoes[] = 'quantidade <= :qtd_minima';
                $parametros[':qtd_minima'] = 5;
            }

            $sql = 'SELECT * FROM produto';
            if (count($condicoes) > 0){
                $sql .= ' WHERE ' . implode(' AND ', $condicoes);
            }
            $sql .= ' ORDER BY nome';

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
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
