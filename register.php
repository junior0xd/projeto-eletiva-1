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
            <form class="" action="">
                <div class="form-floating mb-4">
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="username" placeholder="Digite seu nome de usuário">
                    <label for="username" class="form-label text-light fw-medium">Usuário</label>
                </div>
                </div>
                <div class="form-floating mb-1">
                    <input type="password" class="form-control bg-dark text-white border-secondary" id="password" placeholder="Digite sua senha">
                    <label for="password" class="form-label text-light fw-medium">Senha</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control bg-dark text-white border-secondary" name="confirmPassword" id="confirmPassword" placeholder="Confirme sua senha">
                    <label for="confirmPassword" class="form-label text-light fw-medium">Confirme sua senha</label>
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