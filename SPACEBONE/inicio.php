<?php

    // ===================================================================
    // INICIO
    // ===================================================================

    //verificar a sessão
    if(!isset($_SESSION['a'])){
    exit(); //terminar a execução do codigo aqui
    }

 


?>
<div class="container-fluid pad-20">

    <!-- botão para levar ao setup -->
    <div class="text-center">
    <a href="?a=setup" class="btn btn-secondary">Setup</a>
    </div>
    
</div>