<?php
if(!isset($_SESSION['cargo']) && ($_SESSION['cargo'] !== getenv('ROLE_ADMIN') && $_SESSION['cargo'] !== getenv('ROLE_USER'))) {
    include('forbidden.php');
    exit();
} 
?>