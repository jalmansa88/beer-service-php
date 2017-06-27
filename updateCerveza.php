<?php
/**
 * Actualiza un cerveza especificado por su identificador
 */
require 'Cervezas.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Actualizar cerveza
    $retorno = Cervezas::update(
        $body['id'],
        $body['name'],
		$body['description'],
		$body['country'],
		$body['type'],
		$body['family'],
        $body['alc']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
		echo $json_string;
    }
}
?>