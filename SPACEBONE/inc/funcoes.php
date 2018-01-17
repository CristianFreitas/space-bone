<?php

    // ===================================================================
    // funções estáticas
    // ===================================================================

  //verificar a sessão
if (!isset($_SESSION['a'])) {
    exit(); //terminar a execução do codigo aqui

}

    // =============================================================
class funcoes
{

    public static function VerificarLogin()
    {
        $resultado = false;
        if (isset($_SESSION['id_utilizador'])) {
            $resultado = true;

        }
        return $resultado;
    }
    // =============================================================
    public static function IniciarSessao($dados){
        // iniciar a sessão
        $_SESSION['id_utilizador'] = $dados[0]['id_utilizador'];
        $_SESSION['nome'] = $dados[0]['nome'];
        $_SESSION['email'] = $dados[0]['email'];
        $_SESSION['permissoes'] = $dados[0]['permissoes'];
    }
    // =============================================================
    public static function DestroiSessao()
    {
        unset($_SESSION['id_utilizador']);
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
        unset($_SESSION['permissoes']);

    }

    // =============================================================

    public static function CriarCodigoAlfanumerico($numChars){
        //criar um codigo aleatorio alfanumerico

        $codigo = '';
        $caracteres = 'abcdefghijklmnopqrstuvwyxzABCDEFGHIJKLMNOPQRSTUVWYXZ0123456789!?()-%';

        for($i = 0; $i < $numChars; $i++){
            $codigo .= substr($caracteres, rand(0,strlen($caracteres)),1);
        }
        return $codigo;
    }

    // =============================================================
    public static function CriarLog($mensagem,$utilizador){
       //cria um registro em LOGS
       $gestor = new cl_gestorBD();
       $data_hora = new DateTime();
       $parametros = [
            ':data_hora'    =>  $data_hora->format('Y-m-d H:i:s'),
            ':utilizador'   =>  $utilizador,
            ':mensagem'     =>  $mensagem 
       ];
       $gestor->EXE_NON_QUERY(
            'INSERT INTO logs(data_hora,utilizador,mensagem)
            VALUES(:data_hora,:utilizador,:mensagem)', $parametros);
    }

    public static function Permissao($index){

        // verifica se o utilizador com sessão ativa, tem permissao para a funcionalidade

        if(substr($_SESSION['permissoes'],$index,1)==1){
            return true;
        }else {
            return false;
        }

    }

}

?>