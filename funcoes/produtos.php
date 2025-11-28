<?php
class Produto
{
    public int $pagina_atual;
    public int $total_registros;
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
        error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
        return 2;
    }
    }
    public function atualizar_produto($id, $nome = "", $quantidade = "", $categoria = "", $validade = ""){
        //carrega as informações do produto antes de atualizar
        $stmt_anterior = $this->pdo->prepare('SELECT * FROM produto WHERE id = :id');
        $stmt_anterior->bindParam(':id', $id);
        $stmt_anterior->execute();
        $produto = $stmt_anterior->fetch();
        if($nome == "" ){
            $nome = $produto['nome'];
        }
        if($quantidade == ""){
            $quantidade = $produto['quantidade'];
        }
        if($categoria == ""){
            $categoria = $produto['categoria_id'];
        }
        if($validade == ""){
            $validade = $produto['data_validade'];
        }
        try {
        $stmt = $this->pdo->prepare(
            'UPDATE produto SET nome = :nome, 
                    quantidade = :quantidade, 
                    categoria_id = :categoria_id, 
                    data_validade = :data_validade 
                    WHERE id = :id');
        $stmt->execute(array(
            ':id' => $id,
            ':nome' => $nome,
            ':quantidade' => $quantidade,
            ':categoria_id' => $categoria,
            ':data_validade' => $validade
        ));
        return 1;
        } catch (Exception $e) {
            error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
            return 2;
        }
    }
    public function atualizar_quantidade_entrada($id, $quantidade){
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE produto SET quantidade = quantidade + :quantidade WHERE id = :id');
            $stmt->execute(array(
                ':id' => $id,
                ':quantidade' => $quantidade
            ));
            return 1;
            } catch (Exception $e) {
                error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
                return 2;
            }
    }
    public function atualizar_quantidade_saida($id, $quantidade){
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE produto SET quantidade = quantidade - :quantidade WHERE id = :id');
            $stmt->execute(array(
                ':id' => $id,
                ':quantidade' => $quantidade
            ));
            return 1;
            } catch (Exception $e) {
                error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
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
                $condicoes[] = 'quantidade <= COALESCE(quantidade_minima, :qtd_minima)';
                $parametros[':qtd_minima'] = getenv('QUANTITY_MIN_ALERT');
            }
            //formato da data
            $parametros[':formato_data'] = "%d/%m/%Y";
            $sql = 'SELECT *,
                        DATE_FORMAT(data_validade, :formato_data) as data_validade,
                        DATE_FORMAT(data_validade, "%Y-%m-%d") as data_validade_iso 
                        FROM produto';
            if (count($condicoes) > 0){
                $sql .= ' WHERE ' . implode(' AND ', $condicoes);
            }
            $sql .= ' ORDER BY nome';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $total_registros = $stmt->rowCount();
            if (!empty($opcoes['pagina'])){
                $registros_por_pagina = intval(getenv('RECORDS_PER_PAGE'));
                $total_paginas = ceil($total_registros / $registros_por_pagina);
                $pagina_atual = max(1, min($opcoes['pagina'], $total_paginas));
                $offset = ($pagina_atual - 1) * $registros_por_pagina;
                $sql .= ' LIMIT :limit OFFSET :offset';
                $stmt = $this->pdo->prepare($sql);
                foreach ($parametros as $key => $value) {
                    if ($key === ':limit' || $key === ':offset') {
                        continue;
                    }
                    $stmt->bindValue($key, $value);
                }
                $stmt->bindValue(':limit', (int)$registros_por_pagina, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
                $this->pagina_atual = $pagina_atual;
                $this->total_registros = $total_registros;
                $stmt->execute();
            }
            return $stmt->fetchAll();

            
            
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
        }
        return $produtos;
    }
    public function recuperar_categorias()
    {
        try {
            $stmt = $this->pdo->query("SELECT * from categoria");
            $categorias = $stmt->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage(), 3 | 4, getenv('ERROR_LOG_PATH'));
        }
        return $categorias;
    }
}
