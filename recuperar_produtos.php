<?php 
try {
    $stmt = $pdo->query("SELECT * FROM produto");
    $produtos = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Erro ao recuperar produtos: " . $e->getMessage();
}
?>