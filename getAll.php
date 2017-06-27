<?php
/**
 * Obtiene todas las cervezas de la base de datos
 */
require 'Cervezas.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $cervezas = Cervezas::getAll();
    if ($cervezas) {
        $datos["status"] = 1;
        $datos["cervezas"] = $cervezas;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "status" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}