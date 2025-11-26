<?php
class Usuario{
    public function __construct(protected PDO $pdo) {}
    public function recuperar_usuarios(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function recuperar_usuario_por_id(int $usuario_id){
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function recuperar_usuario_por_cadastro(string $cadastro){
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE cadastro = :cadastro");
        $stmt->bindParam(':cadastro', $cadastro, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function criar_usuario(string $nome, string $cadastro, string $senha_hashed, int $cargo = 1) {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (nome, cadastro, senha, cargo) VALUES (:nome, :cadastro, :senha, :cargo)");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cadastro', $cadastro, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hashed, PDO::PARAM_STR);
        $stmt->bindParam(':cargo', $cargo, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function encriptar_senha(string $senha): string {
        $opcoes = ['cost' => 12];
        return password_hash($senha, PASSWORD_BCRYPT, $opcoes);
    }
    public function atualizar_cargo_usuario(int $usuario_id, int $novo_cargo) {
        $stmt = $this->pdo->prepare("UPDATE usuario SET cargo = :cargo WHERE id = :id");
        $stmt->bindParam(':cargo', $novo_cargo, PDO::PARAM_INT);
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>