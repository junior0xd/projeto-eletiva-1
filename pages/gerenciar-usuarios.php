<?php
require('../funcoes/sessao.php');
require('../funcoes/auth.php');
Auth::verificar_sessao_ativa();
define('IN_APP', true);
require('head-navbar.php');
?>
<main>
</main>
<?php require('footer.php'); ?>
