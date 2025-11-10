<?php 
try {
    $stmt = $pdo->prepare("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Erro ao recuperar produtos: " . $e->getMessage();
}
?>