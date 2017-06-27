<?php
/**
 * Obtiene el detalle de un cerveza especificado por
 * su identificador "id"
 */
require 'Cervezas.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Obtener parámetro id
        $parametro = $_GET['id'];
        // Tratar retorno
        $retorno = Cervezas::getById($parametro);
        if ($retorno) {
            $cerveza["status"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $cerveza["cervezas"] = $retorno;
            // Enviar objeto json del cerveza
            print json_encode($cerveza);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'status' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'status' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}