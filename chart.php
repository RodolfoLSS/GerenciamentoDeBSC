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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            td{
                width: 800px;
                height: 200px;
                position: relative;
            }
            .diagrama{
                border: 5px solid black;
            }
            div{
                overflow-x: auto;
            }
            .items td{
                height: 100%;
            }
        </style>
        <script>
            function allowDrop(event) {
                event.preventDefault();
            }

            function drag(event) {
                event.dataTransfer.setData("text", event.target.id);
            }

            function drop(event) {
                event.preventDefault();
                var data = event.dataTransfer.getData("text");
                event.target.appendChild(document.getElementById(data));
            }
        </script>

</head>

<!--$empresa_id = $_GET["emp"];-->

<body id="page-top" class="index">
    <header>
        <div class="container">
            <h1 class="section-heading">Diagrama</h1>
        </div>
    </header>
<div id="lista" class="bg-light-gray">
    <?php

        require_once('/Library/WebServer/Documents/mysqli_connect.php');

        $fk_empresa = $_GET["id"];

        $query2 = "SELECT descricao FROM objetivo_estrategico WHERE fk_empresa = ".$fk_empresa;

        $query3 = "SELECT meta FROM objetivo_estrategico WHERE fk_empresa = ".$fk_empresa;

        $query4 = "SELECT indicador FROM objetivo_estrategico WHERE fk_empresa = ".$fk_empresa;

        $query5 = "SELECT * FROM iniciativa WHERE fk_empresa = ".$fk_empresa;

        $response2 = @mysqli_query($db_connection, $query2);

        $response3 = @mysqli_query($db_connection, $query3);

        $response4 = @mysqli_query($db_connection, $query4);

        $response5 = @mysqli_query($db_connection, $query5);

        $count = 0;

        echo '<table class="items" align="left" border="0">

        <tr><td align="left">';
        while($linha = mysqli_fetch_array($response2)){
            echo '<p class="page-scroll btn btn-p" id="drag'.$count.'" draggable="true" ondragstart="drag(event)">'.$linha['descricao']. '</p><br>';
            $count = $count + 1;
        }
        echo '</td>';

        echo '<td align="left">';
        while($linha = mysqli_fetch_array($response3)){
            echo '<p class="page-scroll btn btn-p" id="drag'.$count.'" draggable="true" ondragstart="drag(event)">'.$linha['meta']. '</p><br>';
            $count = $count + 1;
        }
        echo '</td>';

        echo '<td align="left">';
        while($linha = mysqli_fetch_array($response4)){
            echo '<p class="page-scroll btn btn-p" id="drag'.$count.'" draggable="true" ondragstart="drag(event)">'.$linha['indicador']. '</p><br>';
            $count = $count + 1;
        }
        echo '</td>';

        echo '<td align="left">';
        while($linha = mysqli_fetch_array($response5)){
            echo '<p class="page-scroll btn btn-p" id="drag'.$count.'" draggable="true" ondragstart="drag(event)">'.$linha['descricao']. '</p><br>';
            $count = $count + 1;
        }
        echo '</td></tr></table>';
    ?>
</div>
<section id="lista" class="bg-light-gray">
    <table class="diagrama" border="1">
            <tr>
                <td class="noBorder"><p class="page-scroll btn btn-p">Financeiro</p></td>
                <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
            </tr>
            <tr>
                <td class="noBorder"><p class="page-scroll btn btn-p">Cliente</p></td>
                <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
            </tr>
            <tr>
                <td class="noBorder"><p class="page-scroll btn btn-p">Processos Internos</p></td>
                <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
            </tr>
            <tr>
                <td class="noBorder"><p class="page-scroll btn btn-p">Pessoas e Tecnologia</p></td>
                <td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
            </tr>
    </table>
<!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>
</section>



</body>

</html>