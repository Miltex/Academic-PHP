<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
    require_once './config/config.php';

    //mysql_connect() -> Cria conexão com o banco de dados
    $conexao = mysql_connect($db_server,$db_user,$db_password);

    //Verificar se a conexão foi realizada com sucesso
    if($conexao){

        //Seleciona banco de dados, caso falhe finaliza o script -> die()
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

        //define consulta SQL de toda tabela locação
        $consulta = "SELECT * FROM locacao;";

        $innerJoin = "SELECT filme.nome AS nomefilme,cliente.nome AS nomecliente,retirada,devolucao FROM locacao
            INNER JOIN cliente ON (cliente.codigo = locacao.cliente)
            INNER JOIN filme ON (filme.codigo = locacao.filme);";

        //Executa consulta SQL
        //$resultado = mysql_query($consulta);
        $resultado = mysql_query($innerJoin);

        //Se a consulta falhar força a finalização do script
        if(!$resultado)
            die("Erro no acesso aos dados".mysql_error());

        //Se não tiver locacoes
        if(mysql_num_rows($resultado)== 0 ){
            die("Nao ha locacoes registradas.");
        }
    }
    else {

        //comando exit() - die() -> força a finalização do script
        //mysql_error() -> fornece menssagem de erro.
       die("Erro na Conexao com o MySQL".mysql_error());

    }
?>

<html>
    <head>

    </head>

    <body>
        <table border="1">
            <tr>
                <td>Filme</td>
                <td>Cliente</td>
                <td>Data Locacao</td>
                <td>Data Devolucao</td>
            </tr>
            <?php
                while ($linha = mysql_fetch_array($resultado)){
                   
                    if($item==0){
                        $cor ="#FFFFFF";
                        $item =1;
                    }else{
                        $cor="C0C0C0";
                        $item =0;
                    }
                    echo "<tr bgcolor=\"$cor\">\n\t
                    <td>".$linha['nomefilme']."</td>\n\t
                    <td>".$linha['nomecliente']."</td>\n\t
                    <td>".$linha['retirada']."</td>\n\t
                    <td>".$linha['devolucao']."</td>\n<tr>\n";
                }
            ?>
            <tr>
                <td colspan="3">
                    Total
                </td>
                <td>
                    <?php echo mysql_num_rows($resultado)?>
                </td>
            </tr>
        </table>
    </body>
</html>
