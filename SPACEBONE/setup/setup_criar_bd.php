<?php

    // ===================================================================
    // setup - cria a base de dados
    // ===================================================================

  //verificar a sessão
if (!isset($_SESSION['a'])) {
    exit(); //terminar a execução do codigo aqui
}

    //cria a base de dados
    $gestor = new cl_gestorBD();

    $configs = include('inc/config.php');

    // apagar a base de dados caso ela exista
    $gestor->EXE_NON_QUERY('DROP DATABASE IF EXISTS ' .$configs['BD_DATABASE']);

    //cria uma nova base de dados
    $gestor->EXE_NON_QUERY('CREATE DATABASE ' .$configs['BD_DATABASE'].' CHARACTER SET UTF8 COLLATE utf8_general_ci');
    $gestor->EXE_NON_QUERY('USE '.$configs['BD_DATABASE']);
    
    // ==================================================
    // CRIAÇÃO DE TABELAS
    // ==================================================

    // --------------------------------
    // utilizadores
    $gestor->EXE_NON_QUERY(
        'CREATE TABLE utilizadores('.
        'id_utilizador          INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, '.
        'utilizador             NVARCHAR(50), '.
        'palavra_passe          NVARCHAR(200),'.
        'nome                   NVARCHAR(50),'.
        'email                  NVARCHAR(50),'.
        'permissoes             NVARCHAR(100),' .
        'criado_em              DATETIME,'.
        'atualizado_em          DATETIME)'
    );

    // -------------------------
    // logs
    $gestor->EXE_NON_QUERY(
        'CREATE TABLE logs('.
        'id_log                         INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, '.
        'data_hora                      DATETIME, '.
        'utilizador                     NVARCHAR(50), '.
        'mensagem                       NVARCHAR(200))'
    );

?>

<div class="alert alert-success text-center">Base de Dados criada com sucesso.</div>
