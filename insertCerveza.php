<?php
/**
 * Insertar un nuevo cerveza en la base de datos
 */
require 'Cervezas.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar Alumno
    $retorno = Cervezas::insert(
        $body['name'],
		$body['description'],
		$body['country'],
		$body['type'],
		$body['family'],
        $body['alc']);
    if ($retorno) {
        $json_string = json_encode(array("status" => 1,"mensaje" => "Creacion correcta"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("status" => 2,"mensaje" => "No se creo el registro"));
		echo $json_string;
    }
}
?>