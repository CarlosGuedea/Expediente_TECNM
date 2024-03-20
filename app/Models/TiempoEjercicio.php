<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: TiempoEjercicio
 *  Database alias: Expediente
 *  Table.........: tiempo_ejercicio
 *  Table alias...: te
 *  Primary key...: id_tiempo_ejercicio
 */
class TiempoEjercicio extends AbstractModel
{
    public $id_tiempo_ejercicio;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['te' => 'tiempo_ejercicio']);

        if (isset($params['id_tiempo_ejercicio'])) {
            $query->where('te.id_tiempo_ejercicio', $params['id_tiempo_ejercicio']);
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

    public static function insert(TiempoEjercicio $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('tiempo_ejercicio', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_tiempo_ejercicio = $result->getInsertedId();
        return $result;
    }

    public static function update(TiempoEjercicio $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('tiempo_ejercicio', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

