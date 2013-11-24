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
        $consulta = "SELECT * FROM aluno;";
        
        //Executa consulta SQL
        $resultado = mysql_query($consulta);

        //Se a consulta falhar força a finalização do script
        if(!$resultado)
            die("Erro no acesso aos dados".mysql_error());

        //Se não tiver clites
        if(mysql_num_rows($resultado)== 0 ){
            die("Nao ha alunos cadastrados.");
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
                <td>Rua</td>
                <td>Matricula</td>
                <td>Bairro</td>
                <td>Cidade</td>
                <td>Cep</td>
                <td>E-mail</td>
                <td colspan="2">Ações</td>

            </tr>
            <?php
                while ($linha = mysql_fetch_array($resultado)){
                    //echo"<tr>\n<td>".$linha['AluCodigo']."</td>\n\t<td>"."\n\t".$linha['AluNome']."</td>\n</tr>\n";
                    if($item==0){
                        $cor ="#FFFFFF";
                        $item =1;
                    }else{
                        $cor="C0C0C0";
                        $item =0;
                    }
                    echo "<tr bgcolor=\"$cor\">\n\t
                    <td>".$linha['AluCodigo']."</td>\n\t
                    <td>".$linha['AluNome']."</td>\n\t
                    <td>".$linha['AluRua']."</td>\n\t
                        <td>".$linha['AluNumero']."</td>\n\t
                            <td>".$linha['AluBairro']."</td>\n\t
                                <td>";
                    $consultaCid = "SELECT CidNome FROM cidade WHERE CidCodigo=".$linha['CidCodigo']." ;";
                    $result = mysql_query($consultaCid);
                    $cid = mysql_fetch_array($result);
                    echo $cid['CidNome'];
                    echo "</td>\n\t
                                <td>".$linha['AluCEP']."</td>\n\t
                    <td>".$linha['AluMail']."</td>\n\t
                    <td>"."<a href=atualizaAluno.php?codigo=".$linha['AluCodigo']."&nome=".$linha['AluNome'].
                    "&rua=".$linha['AluRua']."&matricula=".$linha['AluNumero']."&bairro=".$linha['AluBairro']."&cidade=".$linha['CidCodigo'].
                    "&cep=".$linha['AluCEP']."&email=".$linha['AluMail']."> Editar </a>"."</td>\n\t
                    <td>"."<a href=delete.php?id=".$linha['AluCodigo']."> Deletar </a>"."</td>\n</tr>\n";
                }
            ?>
            <tr>
                <td>
                    Total
                </td>
                <td colspan="8"></td>
                <td>
                    <?php echo mysql_num_rows($resultado)?>
                </td>
            </tr>
        </table>
    </body>
</html>
