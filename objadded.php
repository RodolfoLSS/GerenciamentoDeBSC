<?php

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

    if(empty($_POST['emp_id'])){
        $data_missing[] = 'ID';
    }
    else{
        $id = trim($_POST['emp_id']);
    }

    //////////////////////////////// Insere no banco de dados //////////////////
    
    if(empty($data_missing)){

        require_once('/Library/WebServer/Documents/mysqli_connect.php');

        $query_insert_obj = "INSERT INTO objetivo_estrategico (descricao, fk_empresa, indicador, meta) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($db_connection, $query_insert_obj);
        mysqli_stmt_bind_param($stmt, "siss", $descricao, $id, $indicador, $meta);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            // Cadastro realizado com sucesso
            echo '<script>';
            echo 'alert("Objetivo adicionado.");';
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