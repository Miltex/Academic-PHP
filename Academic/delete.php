<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
require_once './config/config.php';

//mysql_connect() -> Cria conexão com o banco de dados
$conexao = mysql_connect($db_server,$db_user,$db_password);

//Verifica se o id foi enviado
if(isset ($_GET['id'])){
    //Verificar se a conexão foi realizada com sucesso
    if($conexao){

        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL para listar cliente no combo
        $deleteFilme = "DELETE FROM aluno WHERE AluCodigo = '".$_GET['id']."';";


        //Executa consulta SQL
        if(mysql_query($deleteFilme)){
            //Del com sucesso
            echo "<script type='text/javascript'>";
            echo "alert('Registro deletado com sucesso!');";
            echo "location.href = '/Academico/listaAlunos.php '; ";
            echo " </script>";
            
        }else{
            //Falha ao deletar
            echo "<script type='text/javascript'>";
            echo "alert('Nao foi possivel deletar!');";
            echo "location.href = '/Academico/listaAlunos.php'; ";
            echo " </script>";
            
        }
        
    }
    else {

        //comando exit() - die() -> força a finalização do script
        //mysql_error() -> fornece menssagem de erro.
       die("Erro na Conexao com o MySQL".mysql_error());
  }
  
}else{
    //Entra se o id não for enviado
    //Notificação de falha ao receber ID.
    echo "<script type='text/javascript'>";
    echo "alert('Nenhum id foi passado!');";
    echo "location.href = '/Academico/menu.php'; ";
    echo " </script>";
    }
?>