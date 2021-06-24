<?php
require("my_con.php");

function getGoleadores($equipo): array {
    /* SELECT `equip`, `dorsal`, `partits`, `gols`, `penals`, `pp`, `minutsgol`, `gtitular`, `gsuplent`, `gpunts`, `gvictoria`, `gremuntada`, `percent` FROM `golejadors` WHERE 1 */
   
    $conexion = conectar();
    $goleadores = array();
    $sql = "SELECT * FROM golejadors where equip =  ? ORDER BY gols DESC";
    $stm = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stm, "s", $equipo);
    if (!mysqli_stmt_bind_result($stm, $equip, $dorsal, $partits ,$gols,$penals,$pp,$minutsgol,$gtitular,$gsuplent,$gpunts,$gvictoria,$gremuntada,$percent)) 
        echo (mysqli_stmt_errno($stm)." - ".mysqli_stmt_error($stm));
    if (!mysqli_stmt_execute($stm))
        echo (mysqli_stmt_errno($stm)." - ".mysqli_stmt_error($stm));
    while (mysqli_stmt_fetch($stm) != null) {
        $goleador = array();
        $goleador['equip'] = $equip;
        $goleador['dorsal'] = $dorsal;
        $goleador['gols'] = $gols;
        $goleadores[] = $goleador;
    };
    mysqli_stmt_close($stm);
    desconectar($conexion);
    return $goleadores;
}


function getNombreGoleador($equipo,$dorsal) :string {
    $name = "";
    $conexion = conectar();
    $sql = "SELECT nom FROM jugadors where equip = ? and dorsal = ?";
    $stm = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stm, "si", $equipo, $dorsal);
    mysqli_stmt_bind_result($stm, $name);
    mysqli_stmt_execute($stm);
    mysqli_stmt_fetch($stm);
    desconectar($conexion);
    return $name;
}

function getNombreEquipo($eq) :string {
    $name = "";
    $conexion = conectar();
    $sql = "SELECT nomcurt FROM equips where codi = ?";
    $stm = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stm, "s", $eq);
    mysqli_stmt_bind_result($stm, $name);
    mysqli_stmt_execute($stm);
    mysqli_stmt_fetch($stm);
    desconectar($conexion);
    return $name;
}

function updateGoleador($equipo,$dorsal,$goles) {
    $conexion = conectar();
    $sql = "UPDATE golejadors SET gols = ? WHERE equip = ? and dorsal = ?";

    $stm = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stm, "isi", $goles, $equipo, $dorsal);
    $ok = mysqli_stmt_execute($stm);
    mysqli_stmt_close($stm);
    desconectar($conexion);
    return $ok;
}

function equipos(): array
{
    $conexion = conectar();
    $sql = "SELECT * FROM equips";
    $consulta = mysqli_query($conexion, $sql);
    $equipos = array();
    while ($eq = mysqli_fetch_object($consulta)) {
        $equipos[$eq->codi] = $eq->nomcurt;
    }
    desconectar($conexion);
    return $equipos;
}

/*
$goleadores = array();
$goleadores = getGoleadores('bar');
print_r($goleadores);

$lio = getNombreGoleador('val', 11);

echo $lio;

echo(getNombreEquipo('val'));

$equipos = array();
$equipos = equipos();
print_r($equipos);



$as = updateGoleador('val','10','2');

echo $as;

*/