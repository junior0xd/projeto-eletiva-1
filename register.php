<?php
function usuarioJaRegistrado($cadastro, $pdo)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE cadastro = :cadastro");
    $stmt->execute(['cadastro' => $cadastro]);
    return $stmt->fetchColumn() > 0;
}
function echoSucesso($mensagem)
{
    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <div class="ms-4">
                                ' . $mensagem . '
                            </div>
                        </div>';
}

function echoAlerta($mensagem)
{
    echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                            <div class="ms-4">
                                ' . $mensagem . '
                            </div>
                        </div>';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <title>Registro</title>
</head>

<body class="text-bg-dark d-flex justify-content-center align-items-center vh-100">
    <main class="container w-25 mt-5 p-4">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require('conexao.php');
            $nome = $_POST['nome'];
            $cadastro = $_POST['cadastro'];
            $senha = $_POST['senha'];
            $confirmSenha = $_POST['confirmSenha'];

            if ($senha !== $confirmSenha) {
                echoAlerta('As senhas não coincidem. Por favor, tente novamente.');
                exit;
            } elseif (usuarioJaRegistrado($cadastro, $pdo)) {
                echoAlerta('Cadastro já registrado. Por favor, use outro cadastro.');
                exit;
            } else {
                $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

                try {
                    $stmt = $pdo->prepare("INSERT INTO usuario (nome, cadastro, senha) VALUES (:nome, :cadastro, :senha)");
                    if ($stmt->execute(['nome' => $nome, 'cadastro' => $cadastro, 'senha' => $hashedSenha])) {
                        echoSucesso('Usuário registrado com sucesso!');
                        sleep(2);
                        header('Location: login.php');
                    } else {
                        echoAlerta('Falha ao registrar o usuário. Por favor, tente novamente.');
                    }
                } catch (Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
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
                <a href="login.php" class="text-info">Faça login</a>
            </div>
        </form>
    </main>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>