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

        //define consulta SQL por login e senha do cliente
        $consulta = "SELECT * FROM filme;";
        //Executa consulta SQL
        $resultado = mysql_query($consulta);

        //Se a consulta falhar força a finalização do script
        if(!$resultado)
            die("Erro no acesso aos dados".mysql_error());

        //Se não tiver clites
        if(mysql_num_rows($resultado)== 0 ){
            die("Nao ha filmes cadastrados.");
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
                <td>Codigo</td>
                <td>Nome</td>
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
                    <td>".$linha['codigo']."</td>\n\t
                    <td>".$linha['nome']."</td>\n\t
                    <td>"."<a href=atualizar.php?id=".$linha['codigo']."&nome=".$linha['nome']."> Atualizar </a>"."</td>\n\t
                    <td>"."<a href=delete.php?id=".$linha['UsuCodigo']."> Deletar </a>"."</td>\n</tr>\n";
                }
            ?>
            <tr>
                <td>
                    Total
                </td>
                <td>
                    <?php echo mysql_num_rows($resultado)?>
                </td>
            </tr>
        </table>
    </body>
</html>