<?php
// posso pegar o id realizar outra consulta ao bd e mostrar em
//um formulario para o usuário atualizar
//ou
//Pegar por $_GET url exibir em um formulario para o usuário atualizar

include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
require_once './config/config.php';

//mysql_connect() -> Cria conexão com o banco de dados
$conexao = mysql_connect($db_server,$db_user,$db_password);

//Verifica se o id foi enviado
if(isset ($_POST['codigo'])){
    //Verificar se a conexão foi realizada com sucesso
    if($conexao){
        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

$atualizaReg = "UPDATE aluno SET AluNome = '".$_POST['nome']."',
                 AluRua = '".$_POST['rua']."',
                 AluNumero = '".$_POST['matricula']."',
                 AluBairro = '".$_POST['bairro']."',
                 CidCodigo = ".$_POST['cidade'].",
                 AluCEP = '".$_POST['cep']."',
                 AluMail = '".$_POST['email']."'
             WHERE AluCodigo = '".$_POST['codigo']."';";

        //Executa consulta SQL
        if(mysql_query($atualizaReg)){
       
            echo "<script type='text/javascript'>";
            echo "alert('Registro Atualizado com Sucesso!');";
            echo "location.href = '/Academico/listaAlunos.php '; ";
            echo " </script>";

        }else{
           
            echo "<script type='text/javascript'>";
            echo "alert('Nao foi possível atualizar registro!');";
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
