<?php

function estabeleceSessao(){
    //Verifica se exite coockie(se foi criado na autenticação)
    if(isset ($_COOKIE['id'])){
        //seta o id da sessao
        session_id($_COOKIE['id']);
        //Inicia sessão com id -> recebido do coockie
        session_start();
        //Ajusta nome da sessão -> com dados da autenticação do ususário
        session_name($_SESSION['nome']);
    }else{
        //se não, o usuario não foi autenticado,pois o coockie não foi criado
        header('Location: index.php');
    }
}

function logOut(){
    //Verifica se exite coockie
    if(isset ($_COOKIE['id'])){
        //seta o id da sessao
        session_id($_COOKIE['id']);
        session_start();

        if(session_destroy()){
            unset ($_SESSION['codigo']);
            unset ($_SESSION['login']);
            unset ($_SESSION['nome']);
            unset ($_COOKIE['id']);
            
            //Destruir coockie do cliente...
            setcookie('id',$_COOKIE['id'], time()-3600);

            header('Location: index.php');
        }else{
            echo 'falha logout...';
        }
    }else{
        //se não, o usuario não foi autenticado,pois o coockie não foi criado
        header('Location: index.php');
    }
}
?>