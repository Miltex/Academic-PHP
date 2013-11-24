<?php

    //Obtem dados do formulario login
    $login = $_POST['log'];
    $senha = $_POST['senha'];

    //Inclusão do arquivo de configuração
    require_once './config/config.php';

    //mysql_connect() -> Cria conexão com o banco de dados
    $conexao = mysql_connect($db_server,$db_user,$db_password);

    //Verificar se a conexão foi realizada com sucesso
    if($conexao){

        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL por login e senha do cliente
        $consulta = "SELECT * FROM usuario WHERE UsuLogin = '".$login."'AND UsuSenha = '".md5($senha)."';";
        //Executa consulta SQL
        $resultado = mysql_query($consulta);

        //Se a consulta falhar força a finalização do script
        if(!$resultado)
            die("Erro no acesso aos dados".mysql_error());

        //Se o usuário não for autenticado
        if(mysql_num_rows($resultado)== 0 ){

            //header('Location: index.php');

            echo "<script type='text/javascript'>";          
            echo "    alert('Falha na autenticacao!');";
            echo "    location.href = '/Academico/index.php'; ";
            echo " </script>";

           // echo "<a href=index.php>Voltar</a>";

        }else{
            // Se o user for autenticado

            $tupla = mysql_fetch_array($resultado);

            //echo var_dump($tupla);
            //Armazena identificador da sessão no coockie, enquanto
            //navegador aberto
            //trocar UsoCodigo por UsoLogin
            setcookie('id', $tupla['UsuLogin']);
            //setcookie('id', $tupla['codigo'], time() + (60 * 60) );
            //setcookie('id', $tupla['codigo'],time()+3600);1 hora de duração
            
            session_id($tupla['UsuLogin']);
            session_start();
            
            //Registrando sessão para o usuário
            $_SESSION['id'] = $tupla['UsuLogin'];
            $_SESSION['login'] = $tupla['UsuLogin'];
            $_SESSION['nome'] = $tupla['UsuNome'];

            header('Location: menu.php');
            //$linha = mysql_fetch_array($resultado);
            //echo"Seja bem vindo!<br>".mysql_result($resultado,0, 'nome')."</h1>";
            //echo $linha['nome'];
        }
    }
    else {

        //comando exit() - die() -> força a finalização do script
        //mysql_error() -> fornece menssagem de erro.
       die("Erro na Conexao com o MySQL".mysql_error());
       
    }

?>
