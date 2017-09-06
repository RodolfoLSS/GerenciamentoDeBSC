<?php
///////////////////////////// CADASTRO DA EMPRESA ////////////////////////////
if(isset($_POST['submit'])){
    $data_missing = array();

    if(empty($_POST['name'])){
        $data_missing[] = 'Nome';
    }
    else{
        $nome = trim($_POST['name']);
    }

    if(empty($_POST['mission'])){
        $data_missing[] = 'Missão';
    }
    else{
        $missao = trim($_POST['mission']);
    }

    if(empty($_POST['vision'])){
        $data_missing[] = 'Visão';
    }
    else{
        $visao = trim($_POST['vision']);
    }

    ///////////////////////////////// Objetivo estrategico  //////////////////////////

    if(empty($_POST['description'])){
        $data_missing[] = 'Descrição';
    }
    else{
        $descricao = trim($_POST['description']);
    }

    if(empty($_POST['meta'])){
        $data_missing[] = 'Meta';
    }
    else{
        $meta = trim($_POST['meta']);
    }

    if(empty($_POST['indicator'])){
        $data_missing[] = 'Indicador';
    }
    else{
        $indicador = trim($_POST['indicator']);
    }

    ///////////////////////////////// Iniciativa ////////////////////////////

    if(empty($_POST['iniciative'])){
        $data_missing[] = 'Iniciativas';
    }
    else{
        $iniciativa = trim($_POST['iniciative']);
    }

    //////////////////////////////// Insere no banco de dados //////////////////
    
    if(empty($data_missing)){

        require_once('/Library/WebServer/Documents/mysqli_connect.php');

        $query_insert_empresa = "INSERT INTO empresa (missao, visao, nome) VALUES (?, ?, ?)";
        $query_select_key = "SELECT empresa_id FROM empresa WHERE nome = '" . $nome . "'";
        $query_insert_iniciativa = "INSERT INTO iniciativa (descricao, fk_empresa) VALUES (?, ?)";
        $query_insert_obj = "INSERT INTO objetivo_estrategico (descricao, fk_empresa, indicador, meta) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($db_connection, $query_insert_empresa);
        mysqli_stmt_bind_param($stmt, "sss", $missao, $visao, $nome);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            //Procura pela chave da empresa
            $response = @mysqli_query($db_connection, $query_select_key);

            if($response){

                $row = mysqli_fetch_array($response);
                $key_empresa = $row['empresa_id'];

                //Cadastro de objetivo estrategico
                $stmt = mysqli_prepare($db_connection, $query_insert_obj);
                mysqli_stmt_bind_param($stmt, "siss", $descricao, $key_empresa, $indicador, $meta);
                mysqli_stmt_execute($stmt);
                $affected_rows = mysqli_stmt_affected_rows($stmt);

                if($affected_rows == 1){

                    //Cadastro de iniciativa
                    $stmt = mysqli_prepare($db_connection, $query_insert_iniciativa);
                    mysqli_stmt_bind_param($stmt, "si", $iniciativa, $key_empresa);
                    mysqli_stmt_execute($stmt);
                    $affected_rows = mysqli_stmt_affected_rows($stmt);
                }
            }
            else{
                echo '<script>';
                echo 'alert("Erro ao achar chave!");';
                echo 'window.location.href = "cadastro.html";';
                echo '</script>';
            }

            // Cadastro realizado com sucesso
            echo '<script>';
            echo 'alert("Empresa cadastrada!");';
            echo 'window.location.href = "cadastro.html";';
            echo '</script>';
            mysqli_stmt_close($stmt);
            mysqli_close($db_connection);
        }
        else{
            echo 'Erro occurred<br />';
            echo mysqli_error();
        }
    }
    else{
        echo 'Você precisa inserir os seguintes dados<br />';
            foreach($data_missing as $missing){

                echo $missing.'<br />';
            }
    }
}

?>