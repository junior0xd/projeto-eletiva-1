<?php
require('../funcoes/sessao.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
require('head-navbar.php');
?>
<main>
</main>
<?php require('footer.php'); ?>
