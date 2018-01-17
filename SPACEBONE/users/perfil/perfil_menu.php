<?php
    // ========================================
    // perfil - menu inicial
    // ========================================    
    
    // verificar a sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    //vai buscar todas as informaçoes do utilizador

    $gestor = new cl_gestorBD();
    $parametros = [
        'id_utilizador'    =>   $_SESSION['id_utilizador']
    ];
    $dados = $gestor->EXE_QUERY(
        'SELECT * FROM utilizadores 
        WHERE id_utilizador = :id_utilizador',$parametros);
    

?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col card m-3 p-3">
        <h4 class="text-center">PERFIL DO UTILIZADOR</h4>
        <hr>
        <!-- dados do utilizador -->
        <h5><i class="fa fa-user"></i> <?php echo $dados[0]['nome'] ?></h5>
        <p><i class="fa fa-envelope"></i> <?php echo $dados[0]['email'] ?></p>

        </div> 
    </div>
    <div class="text-center">
     <!-- voltar-->
     <a href="?a=inicio" class="btn btn-primary btn-size-150 m-3">Voltar</a>
        </div>
</div>