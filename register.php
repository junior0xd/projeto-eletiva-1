<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <title>Registro</title>
</head>
<body class="text-bg-dark d-flex justify-content-center align-items-center vh-100">
<!--  -->
    <main class="container w-25 mt-5 p-4">
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require('conexao.php');
            $nome = $_POST['nome'];
            $cadastro = $_POST['cadastro'];
            $senha = $_POST['senha'];
            $confirmSenha = $_POST['confirmSenha'];

            if ($senha !== $confirmSenha) {
                echo '<div class="alert alert-danger" role="alert">
                    As senhas não coincidem. Por favor, tente novamente.
                  </div>';
                exit;
            } else {
                $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

                try{
                $stmt = $pdo->prepare("INSERT INTO usuario (nome, cadastro, senha) VALUES (:nome, :cadastro, :senha)");
                if($stmt->execute(['nome' => $nome, 'cadastro' => $cadastro, 'senha' => $hashedSenha])){
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                Registro realizado com sucesso!
                            </div>
                        </div>';
                    sleep(2);
                    header('Location: login.php');
                } else {
                    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Ocorreu um erro ao registrar. Por favor, tente novamente.
                            </div>
                        </div>';
                    }

                } catch (Exception $e){
                    echo 'Error: ' . $e->getMessage();
                }


            }

            echo '<div class="alert alert-success" role="alert">
                    Registro realizado com sucesso!
                  </div>';
        }
        
        ?>
            <form class="" action="register.php" method="POST">
                <div class="form-floating mb-4">
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="nome" name="nome" placeholder="Digite seu nome">
                    <label for="nome" class="form-label text-light fw-medium">Nome</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="cadastro" name="cadastro" placeholder="Digite seu cadastro">
                    <label for="cadastro" class="form-label text-light fw-medium">Cadastro</label>
                </div>
                </div>
                <div class="form-floating mb-1">
                    <input type="password" class="form-control bg-dark text-white border-secondary" id="senha" name="senha" placeholder="Digite sua senha">
                    <label for="senha" class="form-label text-light fw-medium">Senha</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control bg-dark text-white border-secondary" name="confirmSenha" id="confirmSenha" placeholder="Confirme sua senha">
                    <label for="confirmSenha" class="form-label text-light fw-medium">Confirme sua senha</label>
                </div>
                <button type="submit" class="btn btn-success mt-3 w-100">Registrar</button>
                <div class="form-text text-light mt-3">
                    Já possui uma conta? 
                    <a href="#" class="text-info">Faça login</a>
                </div>
            </form>

    </main>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>