<?php

//http://localhost/examen_enric/goleadores_mod.php?equipo=val&dorsal=11
require('bd/my_model.php');
if (isset($_GET['equipo']) && isset($_GET['dorsal'])) {

    $equipo = $_GET['equipo'];
    $dorsal = $_GET['dorsal'];
    $nom = getNombreGoleador($equipo, $dorsal);
}
$men = "";
if (isset($_GET['SubmitButton'])) { //check if form was submitted
    $men = updateGoleador($equipo,$dorsal,$_GET['gols']);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLEJADOR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='form-group'>
        <form action="" method="get">
            <div class="form-group">
                <label>Nombre:</label>
                <input name="nombre" type="text" class="form-control" value="<?php echo $nom ?>" disabled />
            </div>
            <div class="form-group">
                <label>Equipo:</label>
                <input name="equipo" type="text" class="form-control" value="<?php echo $equipo ?>" disabled />
            </div>
            <div class="form-group">
                <label>Dorsal:</label>
                <input name="dorsal" type="text" class="form-control" value="<?php echo $dorsal ?>" disabled />
            </div>
            <div class="form-group">
                <label>Gols:</label>
                <input type="text" name="gols" class="form-control" />
            </div>
            <input type="submit" class='btn btn-primary' name="SubmitButton" />
        </form>
    </div>

    <?php echo $men; ?>
</body>

</html>