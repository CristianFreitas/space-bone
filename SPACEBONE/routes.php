<?php

    //verificar a sessão
if (!isset($_SESSION['a'])) {
    exit(); //terminar a execução do codigo aqui






}

$a = 'inicio';
if (isset($_GET['a'])) {
    $a = $_GET['a'];
}

//funcoes::DestroiSessao();

    // verificar o login
if (!funcoes::VerificarLogin()) {

    // caso especiais
    $routes_especiais = [
        'recuperar_password',
        'setup',
        'setup_criar_bd',
        'setup_inserir_utilizadores'
    ];

    //bypass do sistema normal

    if (!in_array($a, $routes_especiais)) {
        $a = 'login';
    }
}




    // ===================================================================
    // ROUTES
    // ===================================================================

switch ($a) {

    // ===================================================
    // Login
    case 'login' :
        include_once ('users/login.php');
        break;
    // Logout
    case 'logout' :
        include_once ('users/logout.php');
        break;
    // recuperar password
    case 'recuperar_password' :
        include_once ('users/recuperar_password.php');
        break;
    // ===================================================
    // perfil
    case 'perfil' :
        include_once ('users/perfil/perfil_menu.php');
        break;

    // alterar password
    case 'perfil_alterar_password' :
        include_once ('users/perfil/perfil_alterar_password.php');
        break;

    // alterar email
    case 'perfil_alterar_email' :
        include_once ('users/perfil/perfil_alterar_email.php');
        break;

    // ===================================================
    // opçoes do admin

    case 'alterar_utilizadores' :
    include_once ('admin/alterar_utilizadores.php');
    break;

    // formulario para adicionar novo utilizador
    case 'utilizadores_adicionar' :
    include_once ('admin/utilizadores_adicionar.php');
    break;
    
        
    //apresentar a pagina inicial
    case 'inicio' :
        include_once ('inicio.php');
        break;
    //apresenta a pagina acerca de
    case 'about' :
        include_once ('about.php');
        break;
    //abre o menu do setup
    case 'setup' :
        include_once ('setup/setup.php');
        break;

    // ===================================================
    //SETUP
    //setup - criar a base e dados
    case 'setup_criar_bd' :
        include_once ('setup/setup.php');
        break;
    //setup - inserir utilizadores
    case 'setup_inserir_utilizadores' :
        include_once ('setup/setup.php');
        break;
}
