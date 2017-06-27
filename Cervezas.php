<?php
/**
 * Representa el la estructura de las Cervezass
 * almacenadas en la base de datos
 */
require 'Database.php';
class Cervezas
{
    function __construct()
    {
    }
    /**
     * Retorna en la fila especificada de la tabla 'Cervezas'
     *
     * @param $id Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM Cervezas";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Obtiene los campos de un cerveza con un identificador
     * determinado
     *
     * @param $id Identificador del cerveza
     * @return mixed
     */
    public static function getById($id)
    {
        // Consulta de la tabla Cervezas
        $consulta = "SELECT id, name, description, country, type, family, alc
					FROM Cervezas
                    WHERE id = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id));
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $id      identificador
     * @param $name      nuevo nombre
     * @param $description nueva direccion
     
     */
    public static function update(
        $id,
        $name,
        $description,
		$country,
		$type,
		$family,
		$alc
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE Cervezas" .
            " SET name=?, description=?, country=?, type=?, family=?, alc=?" .
            "WHERE id=?";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($name, $description, $country, $type, $family, $alc, $id));
        return $cmd;
    }
    /**
     * Insertar un nuevo cerveza
     *
     * @param $name      name del nuevo registro
     * @param $description dirección del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $name,
        $description,
		$country,
		$type,
		$family,
		$alc
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO Cervezas ( " .
            "name," .
            " description," .
			" country," .
			" type," .
			" family," .
			" alc)" .
            " VALUES( ?,?,?,?,?,?)";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $name,
                $description,
				$country,
				$type,
				$family,
				alc
            )
        );
    }
    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id identificador de la tabla Cervezas
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Cervezas WHERE id=?";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($id));
    }
}
?>