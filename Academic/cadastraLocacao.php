<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
require_once './config/config.php';

//mysql_connect() -> Cria conexão com o banco de dados
$conexao = mysql_connect($db_server,$db_user,$db_password);
//Verifica se o form não foi submetido
if(! isset ($_POST['dataLoc'])){
    //Verificar se a conexão foi realizada com sucesso
    if($conexao){

        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL para listar cliente no combo
        $consultaCliente = "SELECT codigo,nome FROM cliente;";
        //define consulta SQL para listar filme no combo
        $consultafilme = "SELECT codigo,nome FROM filme;";

        //Executa consulta SQL
        $resultCliente = mysql_query($consultaCliente);

        //Executa consulta SQL
        $resultFilme = mysql_query($consultafilme);

        //Se a consulta falhar força a finalização do script
        if(!$resultCliente)
            die("Erro ao acessar cliente".mysql_error());

        //Se a consulta falhar força a finalização do script
        if(!$resultFilme)
            die("Erro ao acessar filme".mysql_error());

        //Se não tiver locacoes
        if(mysql_num_rows($resultCliente)== 0 ){
            die("Nao ha clientes cadastrardos.");
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
        $insertLocacao = "INSERT INTO locacao (filme, cliente, retirada,devolucao)
            VALUES (".$_POST['filme'].",".$_POST['cliente'].",'".$_POST['dataLoc']."','".$_POST['dataDev']."');";



        //Executa consulta SQL
        if(mysql_query($insertLocacao)){
            //Notificação de cadastro realizado com sucesso.
            echo "<script type='text/javascript'>";
            echo "alert('Cadastro realizado com Sucesso !');";
            //redirecionando
            echo "location.href = '/phpprova/listaLocacoes.php'; ";
            echo " </script>";
        }else{
            //Notificação de falha ao cadastrar.
            echo "<script type='text/javascript'>";
            echo "alert('Nao foi possivel dacastrar!');";
            //redirecionando
            echo "location.href = '/phpprova/listaLocacoes.php'; ";

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
        <form name="cadLoc" action="cadastraLocacao.php" method="POST">
            <table>
                <tr>
                    <td>Cliente:</td>
                    <td>
                        <select name="cliente">
                        <?php
                        //Coloca os dados no combo box
                        while ($linha = mysql_fetch_array($resultCliente))
                            echo" <option value=".$linha['codigo'].">".$linha['nome']."</option>";
                        ?>
                        </select>
                    </td>
                    <td>Filme:</td>
                    <td>
                        <select name="filme">
                        <?php
                        while ($linha = mysql_fetch_array($resultFilme))
                            echo" <option value=".$linha['codigo'].">".$linha['nome']."</option>";
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data de Locacao:
                    </td>
                    <td>
                        <input type="text" name="dataLoc"/>
                    </td>
                    <td>
                        Data de Devolucao:
                    </td>
                    <td>
                        <input type="text" name="dataDev"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="right">
                        <input type="reset" value="Limpar"/>
                        <input type="button" name="btnCad" value="Cadastrar" onclick="validaCad()"/>
                    </td>
                </tr>
                               
            </table>
        </form>
    </body>
</html>