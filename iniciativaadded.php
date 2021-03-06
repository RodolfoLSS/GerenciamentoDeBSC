<?php

    ///////////////////////////////// Iniciativa ////////////////////////////

    if(empty($_POST['iniciative'])){
        $data_missing[] = 'Iniciativas';
    }
    else{
        $iniciativa = trim($_POST['iniciative']);
    }

    if(empty($_POST['emp_id'])){
        $data_missing[] = 'ID';
    }
    else{
        $id = trim($_POST['emp_id']);
    }

    //////////////////////////////// Insere no banco de dados //////////////////
    
    if(empty($data_missing)){

        require_once('/Library/WebServer/Documents/mysqli_connect.php');

        $query_insert_iniciativa = "INSERT INTO iniciativa (descricao, fk_empresa) VALUES (?, ?)";

        $stmt = mysqli_prepare($db_connection, $query_insert_iniciativa);
        mysqli_stmt_bind_param($stmt, "si", $iniciativa, $id);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            // Cadastro realizado com sucesso
            echo '<script>';
            echo 'alert("Iniciativa adicionada.");';
            echo 'window.location.href = "addinfo.php";';
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

                echo '$missing<br />';
            }
    }

?>