<?php

    // ===================================================================
    // ABOUT
    // ===================================================================

    //verificar a sessão
    if(!isset($_SESSION['a'])){
    exit(); //terminar a execução do codigo aqui
    }

 
    //ACEDER A BD
    $configs = include('inc/config.php');

    echo $configs['NOME_BD'];


?>

<p>ABOUT</p>