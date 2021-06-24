<?php

require('bd/my_model.php');

$equipos = array();
$equipos = equipos();
$as = "<option value='0'>Seleciona un equipo</option>";

foreach ($equipos as $clave => $valor) {
    $as .= "<option value='$clave'>$valor</option>";
}


$tabla = "
<table class='table table-condensed' >
<tr>
  <th>Equip</th>
  <th>Dorsal</th>
  <th>Gols</th>
</tr>
";


if (isset($_POST['SubmitButton'])) { //check if form was submitted
    $equipo = $_POST['equipo'];
    $goleadores = array();
    $goleadores = getGoleadores($equipo);
    //print_r($goleadores);
    foreach ($goleadores as $valors) {
        $tabla .= "<tr>";
        foreach ($valors as $valor) {
            $tabla .= "<th>$valor</th>";
        }
        $tabla .= "</tr>";
    }
}

$tabla .= "</table>"
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goleadores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='form-group'>
        <form action="" method="post">
            <label>Equipo:</label>
            <select name="equipo" id='mySelect' class='form-control' onchange="">
                <?php echo $as ?>
            </select>
            <input type="submit"  class='btn btn-primary' name="SubmitButton" />
        </form>
    </div>

    <?php echo $tabla; ?>
</body>

</html>