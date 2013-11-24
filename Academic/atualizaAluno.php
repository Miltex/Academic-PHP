<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
estabeleceSessao();

//Inclusão do arquivo de configuração
require_once './config/config.php';

$codigo = $_GET['codigo'];

if(isset ($codigo)){

    $conexao = mysql_connect($db_server,$db_user,$db_password);

     if($conexao)
        mysql_select_db($db_database) or die("Banco de Dados $db_database não pode
                ser acessado:".mysql_error());

    //define consulta SQL por login e senha do cliente
        $consulta = "SELECT * FROM aluno WHERE AluCodigo = ".$codigo.";";
        //Executa consulta SQL
        $resultado = mysql_query($consulta);

        $tupla = mysql_fetch_array($resultado);
  // echo var_dump($tupla);
        //Se a consulta falhar força a finalização do script
        if(!$tupla)
            die("Erro no acesso aos dados".mysql_error());

        $nome = $tupla['AluNome'];
        $codigo =$tupla['AluCodigo'];
        $rua =$tupla['AluRua'];
        $cep =$tupla['AluCep'];
        $cidade =$tupla['CidCodigo'];
        $matricula =$tupla['AluNumero'];
        $bairro =$tupla['AluBairro'];
        $cep = $tupla['AluCEP'];
        $email =$tupla['AluMail'];

        $consultaCidade = "SELECT * FROM cidade;";
        $resultadoCidade = mysql_query($consultaCidade);
        if(!$resultadoCidade)
            die("Erro ao acessar cidade".mysql_error());
        if(mysql_num_rows($resultadoCidade)== 0 )
            die("Nao ha cidades cadastrardos.");


}else{
    echo "<script type='text/javascript'>";
    echo "alert('Algum erro ocorreu !');";
    //redirecionando
    echo "location.href = '/Academico/listaAlunos.php'; ";
    echo " </script>";
}

?>

<html>
    <head>
        <title>Cadastro de Locacao</title>
        <script type="text/javascript" src="./javaScript/scriptValidacao.js"></script>
    </head>

    <body>
        <form name="atualizaAluno" action="atualizar.php" method="POST">
            <table border="0">
                <tr>
                    <td>Codigo: </td><td><input type="text" name="codigo" value="<?php echo $codigo;?>" maxlength="3"/></td>
                    <td>Matricula: </td><td><input type="text" name="matricula" value="<?php echo $matricula;?>" maxlength="9"/></td>

                </tr>
                <tr>
                    <td>Nome: </td><td colspan="3"><input type="text" name="nome" value="<?php echo $nome;?>" size="58" /></td>
                </tr>
                <tr>
                     <td>Rua: </td><td><input type="text" name="rua" value="<?php echo $rua;?> "/></td>
                     <td>Bairro: </td><td><input type="text" name="bairro" value="<?php echo $bairro;?>" /></td>



                </tr>
                <tr>
                    <td>
                        CEP:
                    </td>
                    <td>
                        <input type="text" name="cep" value="<?php echo $cep;?>" maxlength="8"/>
                    </td>
                    <td>
                        E-Mail:
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email;?>" />
                    </td>
                </tr>
                <tr>
                     <td>Cidade/UF:</td>
                     <td>

                        <select name="cidade">
                        <?php
                        //Coloca os dados no combo box
                        while ($linha = mysql_fetch_array($resultadoCidade))
                            echo" <option value=".$linha['CidCodigo'].">".$linha['CidNome']." / ".$linha['CidEstado']."</option>";
                        ?>
                        </select>
                    </td>

                    <td colspan="4" align="right">
                        <input type="button" name="btnCad" value="Atualizar" onclick="atualiza()"/>
                    </td>
                </tr>

            </table>
        </form>
    </body>
</html>
