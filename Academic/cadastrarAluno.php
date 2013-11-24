<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
require_once './config/config.php';

//mysql_connect() -> Cria conexão com o banco de dados
$conexao = mysql_connect($db_server,$db_user,$db_password);
//Verifica se o form não foi submetido
//Posso verificar o FORM diretamente foi submetido ???
if(! isset ($_POST['codigo'])){
    //Verificar se a conexão foi realizada com sucesso
    if($conexao){

        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL para listar cliente no combo
        $consultaCliente = "SELECT CidCodigo,CidNome,CidEstado FROM cidade;";
        //define consulta SQL para listar filme no combo
        //$consultafilme = "SELECT codigo,nome FROM filme;";

        //Executa consulta SQL
        $resultCliente = mysql_query($consultaCliente);

        //Executa consulta SQL
       // $resultFilme = mysql_query($consultafilme);

        //Se a consulta falhar força a finalização do script
        if(!$resultCliente)
            die("Erro ao acessar cidade".mysql_error());

        //Se a consulta falhar força a finalização do script
     //   if(!$resultFilme)
       //     die("Erro ao acessar filme".mysql_error());

        //Se não tiver locacoes
        if(mysql_num_rows($resultCliente)== 0 ){
            die("Nao ha cidades cadastrardos.");
        }
    }
    else {

        //comando exit() - die() -> força a finalização do script
        //mysql_error() -> fornece menssagem de erro.
       die("Erro na Conexao com o MySQL".mysql_error());

    }
}else{
    //Entra se o formulario for enviado

    //se conexão foi realizada com sucesso
    if($conexao){
         //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL para cadastrar locação
      //  $insertLocacao = "INSERT INTO aluno (AluCodigo, AluNome, AluRua,AluNumero,AluBairro,CidCodigo,AluCEP,AluMail)
        //    VALUES (".$_POST['codigo'].",'".$_POST['nome']."','".$_POST['rua']."','"
          //          .$_POST['matricula']."','".$_POST['bairro']."',".$_POST['cidade'].",'".$_POST['cep']."','".$_POST['email']."');";

        $insertLocacao = "INSERT INTO aluno (AluCodigo, AluNome, AluRua,AluNumero,AluBairro,CidCodigo,AluCEP,AluMail)
            VALUES (".$_POST['codigo'].",'".$_POST['nome']."','".$_POST['rua']."','".$_POST['matricula']."','".$_POST['bairro']."',".$_POST['cidade'].",'".$_POST['cep']."','".$_POST['email']."');";

        //Executa consulta SQL
        if(mysql_query($insertLocacao)){
            //Notificação de cadastro realizado com sucesso.
            echo "<script type='text/javascript'>";
            echo "alert('Cadastro realizado com Sucesso !');";
            //redirecionando
            echo "location.href = '/Academico/listaAlunos.php'; ";
            echo " </script>";
        }else{
            //Notificação de falha ao cadastrar.
            echo $_POST['codigo']."<br>".$_POST['nome']."<br>".$_POST['rua']."<br>".
            $_POST['matricula']."<br>".$_POST['bairro']."<br>".$_POST['cidade']."<br>".$_POST['cep']."<br>".$_POST['email'];

            echo "<script type='text/javascript'>";
            echo "alert('Nao foi possivel dacastrar!');";
            //redirecionando
            echo "location.href = '/Academico/listaAlunos.php'; ";

            echo " </script>";
        }

    }
}

?>

<html>
    <head>
        <title>Cadastro de Locacao</title>
        <script type="text/javascript" src="./javaScript/scriptValidacao.js"></script>
    </head>

    <body>
        <form name="cadAluno" action="cadastrarAluno.php" method="POST">
            <table border="0">
                <tr>
                    <td>Codigo: </td><td><input type="text" name="codigo" maxlength="3"/></td>
                    <td>Matricula: </td><td><input type="text" name="matricula" maxlength="9"/></td>
                     
                </tr>
                <tr>
                    <td>Nome: </td><td colspan="3"><input type="text" name="nome" size="58" /></td>
                </tr>
                <tr>
                     <td>Rua: </td><td><input type="text" name="rua"/></td>
                     <td>Bairro: </td><td><input type="text" name="bairro"/></td>

                   
                   
                </tr>
                <tr>
                    <td>
                        CEP:
                    </td>
                    <td>
                        <input type="text" name="cep" maxlength="8"/>
                    </td>
                    <td>
                        E-Mail:
                    </td>
                    <td>
                        <input type="text" name="email"/>
                    </td>
                </tr>
                <tr>
                     <td>Cidade/UF:</td>
                     <td>
                       
                        <select name="cidade">
                        <?php
                        //Coloca os dados no combo box
                        while ($linha = mysql_fetch_array($resultCliente))
                            echo" <option value=".$linha['CidCodigo'].">".$linha['CidNome']." / ".$linha['CidEstado']."</option>";
                        ?>
                        </select>
                    </td>
               
                    <td colspan="4" align="right">
                        <input type="reset" value="Limpar"/>
                        <input type="button" name="btnCad" value="Cadastrar" onclick="validaCad()"/>
                    </td>
                </tr>

            </table>
        </form>
    </body>
</html>
