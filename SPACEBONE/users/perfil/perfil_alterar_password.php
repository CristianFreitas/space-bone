<?php
    // ========================================
    // perfil - alterar password
    // ========================================    
    
    // verificar a sessão
if (!isset($_SESSION['a'])) {
    exit();
}

    //define o erro
$erro = false;
$sucesso = false;
$mensagem = '';

    //verifica se foi feito post

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //busca os valores inseridos nos inputs
    $password_atual = $_POST['text_password_atual'];
    $password_nova1 = $_POST['text_password_nova1'];
    $password_nova2 = $_POST['text_password_nova2'];

    $gestor = new cl_gestorBD();
        
        // ----------------------------------------------
        //verificaçoes

        // verifica se a password atual está correta
    $parametros = [
        ':id_utilizador' => $_SESSION['id_utilizador'],
        ':palavra_passe' => md5($password_atual)
    ];

        // Armazena dados de pesquisa
    $dados = $gestor->EXE_QUERY(
        'SELECT id_utilizador, palavra_passe FROM utilizadores
            WHERE id_utilizador = :id_utilizador
            AND palavra_passe = :palavra_passe',
        $parametros
    );

    if (count($dados) == 0) {
            //password atual errada
        $erro = true;
        $mensagem = 'A password atual está incorreta.';

    }

    if (!$erro) {
            //verificar se as duas password novas coincidem
        if ($password_nova1 != $password_nova2) {
            $erro = true;
            $mensagem = 'A nova password e a confirmação de senha não coincidem';


        }
    }
        // Caso não tenha erro irá atualizar a bd
    if (!$erro) {
        $data_atualizacao = new DateTime();

        $parametros = [
            ':id_utilizador' => $_SESSION['id_utilizador'],
            ':palavra_passe' => md5($password_nova1),
            ':atualizado_em' => $data_atualizacao->format('Y-m-d H:i:s')
        ];

        $gestor->EXE_NON_QUERY(
            'UPDATE utilizadores SET
                palavra_passe = :palavra_passe,
                atualizado_em = :atualizado_em
                WHERE id_utilizador = :id_utilizador
                ',
            $parametros
        );
        $sucesso = true;
        $mensagem = 'Password atualizado com sucesso.';
       
                // LOG
        funcoes::CriarLog('Utilizador ' . $_SESSION['nome'] . ' alterou a password.', $_SESSION['nome']);

    }
}


?>


<?php if ($erro) : ?>
<div class="alert alert-danger text-center">
   <?php echo $mensagem ?>
</div>
<?php endif; ?>

<?php if ($sucesso) : ?>
<div class="alert alert-success text-center">
   <?php echo $mensagem ?>
</div>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col card m-3 p-3">
            <h4 class="text-center">ALTERAR PASSWORD</h4>

            <hr>

        <!-- formulário -->

        <form action="?a=perfil_alterar_password" method="post">
        
        <div class="col-sm-4 offset-sm-4 justify-content-center">
            <div class="form-group">
                <label>Password Atual:</label>
                <input type="text" required title="No minimo 3 caracteres." pattern=".{3,}" class="form-control" name="text_password_atual">
            </div>
        </div>

        <div class="col-sm-4 offset-sm-4 justify-content-center">
            <div class="form-group">
                <label>Nova Password:</label>
                <input type="text" required title="No minimo 3 caracteres." pattern=".{3,}" class="form-control" name="text_password_nova1">
            </div>
        </div>

        <div class="col-sm-4 offset-sm-4 justify-content-center">
            <div class="form-group">
                <label>Repetir a nova password:</label>
                <input type="text" required title="No minimo 3 caracteres." pattern=".{3,}" class="form-control" name="text_password_nova2">
            </div>
        </div>

        <div class="text-center">
              <a href="?a=perfil" class="btn btn-primary btn-size-150">Voltar</a>
            <button role="submit" class="btn btn-primary btn-size-150">Alterar</button>
        </div>

        </form>

        </div>        
    </div>
</div>

