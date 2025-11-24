<?php
class Usuario{
    public function __construct(protected PDO $pdo) {}
    public function recuperar_usuarios(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function atualizar_cargo_usuario(int $usuario_id, int $novo_cargo) {
        $stmt = $this->pdo->prepare("UPDATE usuario SET cargo = :cargo WHERE id = :id");
        $stmt->bindParam(':cargo', $novo_cargo, PDO::PARAM_INT);
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>