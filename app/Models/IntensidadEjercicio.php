<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: IntensidadEjercicio
 *  Database alias: Expediente
 *  Table.........: intensidad_ejercicio
 *  Table alias...: ie
 *  Primary key...: id_intensidad_ejercicio
 */
class IntensidadEjercicio extends AbstractModel
{
    public $id_intensidad_ejercicio;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['ie' => 'intensidad_ejercicio']);

        if (isset($params['id_intensidad_ejercicio'])) {
            $query->where('ie.id_intensidad_ejercicio', $params['id_intensidad_ejercicio']);
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

    public static function insert(IntensidadEjercicio $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('intensidad_ejercicio', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_intensidad_ejercicio = $result->getInsertedId();
        return $result;
    }

    public static function update(IntensidadEjercicio $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('intensidad_ejercicio', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

