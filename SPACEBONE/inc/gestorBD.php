<?php
    // =======================================================================================
    // gestor | gestor de BD MySQL PDO
    // =======================================================================================

    /*

    Create
    Read
    Update
    Delete

    */

class cl_gestorBD
{


    //==================================================================
    public function EXE_QUERY($query, $parametros = null, $fechar_ligacao = true)
    {
        //executa a query à base de dados (SELECT)
        $resultados = null;
        $config = include('inc/config.php');
        //abre a ligação à base de dados
        $ligacao = new PDO(
            'mysql:host='.$config['BD_HOST'].
            ';dbname='.$config['BD_DATABASE'].
            ';charset='.$config['BD_CHARSET'],
            $config['BD_USERNAME'],
            $config['BD_PASSWORD'],
            array(PDO::ATTR_PERSISTENT => true));
        $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //executa a query
        if ($parametros != null) {
            $gestor = $ligacao->prepare($query);
            $gestor->execute($parametros);
            $resultados = $gestor->fetchAll(PDO::FETCH_ASSOC);
        } else {
            //query sem parametro
            $gestor = $ligacao->prepare($query);
            $gestor->execute();
            $resultados = $gestor->fetchAll(PDO::FETCH_ASSOC);
        }
        #fecha a ligação por defeito
        if ($fechar_ligacao) {
            $ligacao = null;
        }
        #retorna os resultados
        return $resultados;
    }
    //==================================================================
    public function EXE_NON_QUERY($query, $parametros = null, $fechar_ligacao = true)
    {
        //executa uma query com ou sem parâmetros (INSERT, UPDATE, DELETE)
        $config = include('inc/config.php');
        //abre a ligação à base de dados
        $ligacao = new PDO(
            'mysql:host='.$config['BD_HOST'].
            ';dbname='.$config['BD_DATABASE'].
            ';charset='.$config['BD_CHARSET'],
            $config['BD_USERNAME'],
            $config['BD_PASSWORD'],
            array(PDO::ATTR_PERSISTENT => true));
        $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //executa a query
        $ligacao->beginTransaction();
        try {
            if ($parametros != null) {
                $gestor = $ligacao->prepare($query);
                $gestor->execute($parametros);
            } else {
                $gestor = $ligacao->prepare($query);
                $gestor->execute();
            }
            $ligacao->commit();
        } catch (PDOException $e) {
            echo '<p>' . $e . '</p>';
            $ligacao->rollBack();
        }
        #fecha a ligacao por defeito
        if ($fechar_ligacao) {
            $ligacao = null;
        }
    }
    //==================================================================
    public function RESET_AUTO_INCREMENT($tabela)
    {
        
        //faz reset ao auto_increment de uma determinada tabela ($tabela)
        $config = include('inc/config.php');
        //abre a ligação à base de dados
        $ligacao = new PDO(
            'mysql:host='.$config['BD_HOST'].
            ';dbname='.$config['BD_DATABASE'].
            ';charset='.$config['BD_CHARSET'],
            $config['BD_USERNAME'],
            $config['BD_PASSWORD'],
            array(PDO::ATTR_PERSISTENT => true));
        $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //reset ao auto_increment
        $ligacao->exec('ALTER TABLE '.$tabela.' AUTO_INCREMENT = 1');
        //fecha a ligacao
        $ligacao = null;
    }
}
