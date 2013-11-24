<?php
include 'sessao.php';
//Estabelecendo sessão com usuário autenticado
   estabeleceSessao();

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/estilos.css"/>
        <title>Acadêmico</title>
    </head>

    <body>

        <div class="menu" align="center">
                <?php echo "<a href=cadastrarAluno.php target="."iframe"."> Cadastrar Alunos </a>";?>
                <?php echo "<a href=listaAlunos.php target="."iframe"."> Listar Alunos </a>";?>
                <?php //echo "<a href=listaFilmes.php target="."iframe"."> Listar Filmes </a>";?>
                <?php //echo "<a href=listaLocacoes.php target="."iframe"."> Listar Locacoes </a>";?>
                <?php echo "<a href=logout.php> Sair </a>";?>            
        </div>
        <div align="center">
            <?php //Nome da sessão e id da sessão são setados no estabelece sessão.
            echo "Bem vindo(a) ".session_name().",  Login: ".session_id();?>
        </div>
        <div align="center" >
            <iframe src="listaAlunos.php" name="iframe" width="80%" height="90%"></iframe>
        </div>
        
    </body>

</html>

