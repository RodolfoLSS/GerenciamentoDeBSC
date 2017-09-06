<?php
    $id = $_GET["id"];

    if(empty($id)){
        $data_missing[] = 'ID';
    }

    //////////////////////////////// Insere no banco de dados //////////////////
    
    if(empty($data_missing)){

        require_once('/Library/WebServer/Documents/mysqli_connect.php');

        $query_delete_empresa = "DELETE FROM empresa WHERE empresa_id = ?";
        
        $stmt = mysqli_prepare($db_connection, $query_delete_empresa);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo '<script>';
            echo 'alert("Empresa deletada!");';
            echo 'window.location.href = "getcadastro.php";';
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

?>