<?php
function validar_dados($dados)
{
    $dados = trim($dados);
    return $dados;
}
function validar_senha($senha){
    if (strlen($senha) < getenv('PASSWORD_LENGTH_MIN')) {
        return false;
    }
    return true;
}
