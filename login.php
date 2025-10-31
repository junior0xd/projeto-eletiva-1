<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="text-bg-dark d-flex justify-content-center align-items-center vh-100">
    <main class="container w-25 mt-5 p-4">
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require('conexao.php');
            $cadastro = $_POST['cadastro'];
            $senha = $_POST['password'];
            try{
                $stmt = $pdo->prepare("SELECT * FROM usuario WHERE cadastro = :cadastro");
                $stmt->execute(['cadastro' => $cadastro]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                if($usuario && password_verify($senha, $usuario['senha'])){
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                Login realizado com sucesso!
                            </div>
                        </div>';
                    sleep(2);
                    session_start();
                    $_SESSION['acesso'] = true;
                    $_SESSION['nome_usuario'] = $usuario['nome'];
                    $_SESSION['cadastro_usuario'] = $usuario['cadastro'];
                    header('Location: landpage.php');
                } else {
                    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Cadastro ou senha incorretos. Por favor, tente novamente.
                            </div>
                        </div>';
                }

            } catch (Exception $e){
                echo 'Error: ' . $e->getMessage();
            }

        }
        
        ?>
            <form  action="login.php" method="POST">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="cadastro" placeholder="Digite seu cadastro" name="cadastro">
                    <label for="cadastro" class="form-label text-light fw-medium">Cadastro</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control bg-dark text-white border-secondary" id="password" placeholder="Digite sua senha" name="password">
                    <label for="password" class="form-label text-light fw-medium">Senha</label>
                </div>
                <a href="#" class="fs-6 text-info">Esqueci minha senha</a>
                <button type="submit" class="btn btn-success mt-3 w-100">Entrar</button>
                <div class="form-text text-light mt-3">
                    Ainda não possui uma conta? 
                    <a href="#" class="text-info">Cadastre-se</a>
                </div>
            </form>
    </main>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>