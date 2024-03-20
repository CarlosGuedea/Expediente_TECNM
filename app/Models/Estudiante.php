<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Estudiante
 *  Database alias: Expediente
 *  Table.........: estudiante
 *  Table alias...: e
 *  Primary key...: id_estudiante
 */
class Estudiante extends AbstractModel
{
    public $id_estudiante;
    public $id_estado_civil;
    public $id_carrera;
    public $tipo_sangre;
    public $tabaquismo;
    public $alcoholismo;
    public $lugar_residencia;
    public $toxicomanias;
    public $enfermedades_actuales;
    public $lugar_nacimiento;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['e' => 'estudiante']);

        if (isset($params['id_estudiante'])) {
            $query->where('e.id_estudiante', $params['id_estudiante']);
        }

        // DO NOT REMOVE, checks if passed params are not used in code block.
        $params->checkUsed();
        return $query;
    }

    /**
     *  @return self[]
     */
    public static function getRows(array $params = [])
    {
        $db = DatabaseManager::connect('Expediente');
        $query = static::getQuery($params);
        $result = $db->executeSelect($query);
        return $result->toArray(self::class);
    }

    public static function getFirst(array $params = [])
    {
        $rows = static::getRows($params);
        return reset($rows) ?: null;
    }

    public static function getLast(array $params = [])
    {
        $rows = static::getRows($params);
        return end($rows) ?: null;
    }

    public static function insert(Estudiante $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('estudiante', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_estudiante = $result->getInsertedId();
        return $result;
    }

    public static function update(Estudiante $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('estudiante', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
