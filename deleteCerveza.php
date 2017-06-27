<?php
/**
 * Elimina un alumno de la base de datos
 * distinguido por su identificador
 */
require 'Cervezas.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $retorno = Cervezas::delete($body['id']);
	//$json_string = json_encode($clientes);
	//echo 'antes de entrar';
    if ($retorno) {
        $json_string = json_encode(array("status" => 1,"mensaje" => "Eliminacion exitosa"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("status" => 2,"mensaje" => "No se elimino el registro"));
		echo $json_string;
    }
}
?>