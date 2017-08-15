<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gerenciamento de BSC">
    <meta name="author" content="Rodolfo Saldanha">

    <title>Gerenciamento de empresas</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <link href="css/bsc.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->
</head>

<body>
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
        //$query_insert_iniciativa = "INSERT INTO iniciativa (descricao, fk_empresa) VALUES (?, ?)";
        $query_insert_obj = "INSERT INTO empresa (missao, visao, nome) VALUES (?, ?, ?)";

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

                echo '$missing<br />';
            }
    }
}

?>
</body>
</html>