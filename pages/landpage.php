<?php
require('../auth.php');
require('../database/conexao.php');
require('../echo-out.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome_produto = $_POST['nome_produto'];
    $quantidade_produto = $_POST['quantidade_produto'];
    try {
        $stmt_checar = $pdo->prepare("SELECT COUNT(*) FROM produto WHERE nome = :nome_produto");
        $stmt_checar->bindParam(":nome_produto", $nome_produto, PDO::PARAM_STR);
        $stmt_checar->execute();
        $contador = $stmt_checar->fetchColumn();
        if($contador > 0){
            //O produto já existe no estoque
            $produto_existe = true;
        } else{
            $stmt = $pdo->prepare("INSERT INTO produto (nome, quantidade) VALUES (?, ?)");
            if($stmt->execute([$nome_produto, $quantidade_produto])){
            $produto_adicionado = true;
            
        }
        }
    } catch (Exception $e) {
        echo("Ocorreu um erro ao adicionar um novo produto: " . $e->getMessage());
    }
}
require('../recuperar_produtos.php');
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap.min.css" rel="stylesheet">
    <title>Land Page</title>
</head>
<body class="">
    <nav class="navbar navbar-expand bg-black bg-opacity-10 navbar-dark px-2 py-3 mt-1">
        <div class="container-fluid">
            <a class="navbar-brand p-0 me-0 text-center col-1" href="#">
                <div class="flex flex-row align-items-center">
                    <svg class="img-fluid" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2.5em" height="2.5em" zoomAndPan="magnify" viewBox="0 0 540 540.000001"  preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="34fdd092e4"><path d="M 262 5 L 539.5 5 L 539.5 539 L 262 539 Z M 262 5 " clip-rule="nonzero"/></clipPath><clipPath id="781028c912"><path d="M 421.492188 102.503906 L 539.492188 102.503906 L 539.492188 220.503906 L 421.492188 220.503906 Z M 421.492188 102.503906 " clip-rule="nonzero"/></clipPath><clipPath id="8af95636d0"><path d="M 480.492188 102.503906 C 447.90625 102.503906 421.492188 128.921875 421.492188 161.503906 C 421.492188 194.089844 447.90625 220.503906 480.492188 220.503906 C 513.078125 220.503906 539.492188 194.089844 539.492188 161.503906 C 539.492188 128.921875 513.078125 102.503906 480.492188 102.503906 Z M 480.492188 102.503906 " clip-rule="nonzero"/></clipPath><clipPath id="16561ac625"><path d="M 143 75 L 539.5 75 L 539.5 523 L 143 523 Z M 143 75 " clip-rule="nonzero"/></clipPath><clipPath id="a05e270f73"><path d="M 156 160 L 539.5 160 L 539.5 539 L 156 539 Z M 156 160 " clip-rule="nonzero"/></clipPath><clipPath id="e562a64a01"><path d="M 0.5 9 L 278 9 L 278 539 L 0.5 539 Z M 0.5 9 " clip-rule="nonzero"/></clipPath><clipPath id="f629ca0c8d"><path d="M 0.5 102.503906 L 118.5 102.503906 L 118.5 220.503906 L 0.5 220.503906 Z M 0.5 102.503906 " clip-rule="nonzero"/></clipPath><clipPath id="a3f14d0d49"><path d="M 59.5 102.503906 C 26.914062 102.503906 0.5 128.921875 0.5 161.503906 C 0.5 194.089844 26.914062 220.503906 59.5 220.503906 C 92.085938 220.503906 118.5 194.089844 118.5 161.503906 C 118.5 128.921875 92.085938 102.503906 59.5 102.503906 Z M 59.5 102.503906 " clip-rule="nonzero"/></clipPath><clipPath id="386572a8f0"><path d="M 0.5 79 L 397 79 L 397 525 L 0.5 525 Z M 0.5 79 " clip-rule="nonzero"/></clipPath><clipPath id="ea74110117"><path d="M 0.5 170 L 383 170 L 383 539 L 0.5 539 Z M 0.5 170 " clip-rule="nonzero"/></clipPath><clipPath id="8b46d327f4"><path d="M 0.5 0 L 539.5 0 L 539.5 338 L 0.5 338 Z M 0.5 0 " clip-rule="nonzero"/></clipPath><clipPath id="c29b34c29a"><path d="M 210.085938 5.644531 L 300.621094 5.644531 L 300.621094 97.664062 L 210.085938 97.664062 Z M 210.085938 5.644531 " clip-rule="nonzero"/></clipPath><clipPath id="c146a2f3d4"><path d="M 255.335938 5.644531 C 230.34375 5.644531 210.085938 26.238281 210.085938 51.644531 C 210.085938 77.046875 230.34375 97.640625 255.335938 97.640625 C 280.324219 97.640625 300.585938 77.046875 300.585938 51.644531 C 300.585938 26.238281 280.324219 5.644531 255.335938 5.644531 Z M 255.335938 5.644531 " clip-rule="nonzero"/></clipPath><clipPath id="a3d20eb82b"><path d="M 72 0 L 539.5 0 L 539.5 420 L 72 420 Z M 72 0 " clip-rule="nonzero"/></clipPath></defs><g clip-path="url(#34fdd092e4)"><path stroke-linecap="butt" transform="matrix(-0.081127, -0.744205, 0.744205, -0.081127, 472.415968, 525.115243)" fill="none" stroke-linejoin="miter" d="M 5.861237 49.634781 C 141.876059 16.119693 277.890112 16.123939 413.904526 49.637147 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#781028c912)"><g clip-path="url(#8af95636d0)"><path stroke-linecap="butt" transform="matrix(0.748614, 0, 0, 0.748614, 421.491818, 102.505421)" fill="none" stroke-linejoin="miter" d="M 78.812842 -0.00202295 C 35.284464 -0.00202295 0.000493174 35.287166 0.000493174 78.810326 C 0.000493174 122.338703 35.284464 157.622675 78.812842 157.622675 C 122.341219 157.622675 157.625191 122.338703 157.625191 78.810326 C 157.625191 35.287166 122.341219 -0.00202295 78.812842 -0.00202295 Z M 78.812842 -0.00202295 " stroke="#ffffff" stroke-width="30" stroke-opacity="1" stroke-miterlimit="4"/></g></g><g clip-path="url(#16561ac625)"><path stroke-linecap="butt" transform="matrix(-0.738956, 0.119861, -0.119861, -0.738956, 484.15102, 320.541647)" fill="none" stroke-linejoin="miter" d="M 14.472256 53.346663 C 66.990958 14.887098 119.509537 14.884435 172.032308 53.344659 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#a05e270f73)"><path stroke-linecap="butt" transform="matrix(0.428457, -0.613879, 0.613879, 0.428457, 336.638126, 501.222059)" fill="none" stroke-linejoin="miter" d="M 5.816403 40.837089 C 94.911849 19.052972 174.941796 19.052415 245.901964 40.838402 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#e562a64a01)"><path stroke-linecap="butt" transform="matrix(0.0868906, -0.743554, 0.743554, 0.0868906, 11.380546, 515.992506)" fill="none" stroke-linejoin="miter" d="M 6.945346 23.825021 C 125.759295 58.945113 258.367942 58.946444 404.760318 23.825041 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#f629ca0c8d)"><g clip-path="url(#a3f14d0d49)"><path stroke-linecap="butt" transform="matrix(0.748614, 0, 0, 0.748614, 0.499075, 102.505421)" fill="none" stroke-linejoin="miter" d="M 78.813584 -0.00202295 C 35.285207 -0.00202295 0.00123523 35.287166 0.00123523 78.810326 C 0.00123523 122.338703 35.285207 157.622675 78.813584 157.622675 C 122.341962 157.622675 157.625933 122.338703 157.625933 78.810326 C 157.625933 35.287166 122.341962 -0.00202295 78.813584 -0.00202295 Z M 78.813584 -0.00202295 " stroke="#ffffff" stroke-width="30" stroke-opacity="1" stroke-miterlimit="4"/></g></g><g clip-path="url(#386572a8f0)"><path stroke-linecap="butt" transform="matrix(-0.741684, -0.101626, 0.101626, -0.741684, 194.471891, 343.610496)" fill="none" stroke-linejoin="miter" d="M 14.639465 53.343705 C 66.256042 14.886687 117.875342 14.886986 169.492195 53.345311 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#ea74110117)"><path stroke-linecap="butt" transform="matrix(-0.434076, -0.609918, 0.609918, -0.434076, 164.100371, 533.346664)" fill="none" stroke-linejoin="miter" d="M 6.884219 23.513033 C 103.895179 51.912052 180.980399 51.911916 238.139878 23.512625 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#8b46d327f4)"><path stroke-linecap="butt" transform="matrix(-0.745054, 0.0729204, -0.0729204, -0.745054, 374.713464, 144.939458)" fill="none" stroke-linejoin="miter" d="M 18.999272 114.039454 C 106.86258 -6.677524 189.318222 -6.681455 266.380758 114.039572 " stroke="#ffffff" stroke-width="47" stroke-opacity="1" stroke-miterlimit="4"/></g><g clip-path="url(#c29b34c29a)"><g clip-path="url(#c146a2f3d4)"><path stroke-linecap="butt" transform="matrix(0.748614, 0, 0, 0.748614, 210.084622, 5.645252)" fill="none" stroke-linejoin="miter" d="M 60.446821 -0.000963106 C 27.062194 -0.000963106 0.00175679 27.50822 0.00175679 61.445953 C 0.00175679 95.378468 27.062194 122.887651 60.446821 122.887651 C 93.82623 122.887651 120.891885 95.378468 120.891885 61.445953 C 120.891885 27.50822 93.82623 -0.000963106 60.446821 -0.000963106 Z M 60.446821 -0.000963106 " stroke="#ffffff" stroke-width="26" stroke-opacity="1" stroke-miterlimit="4"/></g></g><path stroke-linecap="butt" transform="matrix(-0.0953366, 0.742518, -0.742518, -0.0953366, 277.861455, 133.629969)" fill="none" stroke-linejoin="miter" d="M 6.16911 34.742246 C 58.639076 21.087327 106.180839 21.085684 148.805414 34.741165 " stroke="#ffffff" stroke-width="49" stroke-opacity="1" stroke-miterlimit="4"/><g clip-path="url(#a3d20eb82b)"><path stroke-linecap="butt" transform="matrix(-0.620793, -0.418376, 0.418376, -0.620793, 357.802251, 258.078376)" fill="none" stroke-linejoin="miter" d="M 14.61934 52.033184 C 62.506743 13.989969 115.839876 13.988689 174.621653 52.033671 " stroke="#ffffff" stroke-width="47" stroke-opacity="1" stroke-miterlimit="4"/></g></svg>
                </div>
            </a>
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="ms-2 nav-link active fs-5" aria-current="page" href="#">Início</a>
                </li>
            </ul>
            <div class="navbar-nav ms-auto dropdown">
                <input class="btn btn-outline-success dropdown-toggle me-2 text-white" value=<?=$_SESSION['nome_usuario']?> type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu w-100 dropdown-menu-end dropdown-menu-dark dropdown-menu-start">
                    <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                    <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                </ul>            
            </div>
        </div>
    </nav>
    <main class="container w-100 mt-4">
        <div class="row">
                <div class="offset-lg-10 offset-md-8 offset-8 col-lg-2 mt-3 col-md-4 col-4 d-flex justify-content-center">
                    <a href="add-item.php" class="btn btn-success w-75" data-bs-toggle="modal" data-bs-target="#adicionar_produtos">Novo Item</a>
                </div>
                <?php require('../adicionar_produtos_modal.php') ?>
            </div>
        <form>
            <div class="row justify-content-center">
                <?php if($produto_existe){echoAlertaWarning("Produto já existe no estoque");}?>
                <div class="col-6 col-md-8 col-lg-10">
                    <div class="input-group text-white mt-2">
                        <span class="input-group-text">
                            <svg class="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                        </span>
                    <input type="text" class="form-control fw-medium" placeholder="Procurar..." name="produto_procurado" id="produto_procurado">
                    </div>
                </div>
                <div class="col-auto mt-2">
                    <button class="btn btn-outline-light ms-0" type="submit">Buscar</button>
                    <input class="btn btn-outline-info ms-1" type="button" value="Filtros" data-bs-toggle="collapse" data-bs-target="#filtros">
                </div>
                <div class="collapse" id="filtros">
                    <div class=" offset-sm-8 card card-body mt-3 bg-black bg-opacity-10 border-secondary">
                        <form action="">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Tipo</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="switchEnfermagem" id="switchEnfermagem">
                                                <label class="form-check-label" for="switchEnfermagem">
                                                    Enfermagem
                                                </label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" role="switch" name="checkboxVencidos" id="checkboxVencidos">
                                                <label class="form-check-label" for="checkboxVencidos">
                                                    Vencidos
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" name="switchEscritorio" id="switchEscritorio">
                                                <label for="switchEscritorio">
                                                    Escritório
                                                </label>
                                            </div>
                                        </th>
                                         <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" role="switch" name="checkboxBaixoEstoque" id="checkboxBaixoEstoque">
                                                <label class="form-check-label" for="checkboxBaixoEstoque">
                                                    Baixo Estoque
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" role="switch" name="checkboxProximosVencimento" id="checkboxProximosVencimento">
                                                <label class="form-check-label" for="checkboxProximosVencimento">
                                                    Próximos a vencer
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-info align-self-end">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </form>
        <div class="container border mt-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produtos)){
                        echo "<tr><td colspan='4' class='fs-5 fw-normal'>Nenhum produto cadastrado</td></tr>";
                    }?>
                    <?php foreach ($produtos as $prod): ?>
                    <tr>
                        <td><?= $prod['id']; ?></td>
                        <td><?= $prod['nome']; ?></td>
                        <td><?= $prod['descricao']; ?></td>
                        <td><?= $prod['quantidade']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../bootstrap.bundle.min.js"></script>
</body>
</html>