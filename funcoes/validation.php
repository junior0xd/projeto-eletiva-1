<?php
function validar_dados($dados)
{
    $dados = trim($dados);
    return $dados;
}
function validar_senha($senha){
    if (strlen($senha) < 8) {
        return false;
    }
    return true;
}
