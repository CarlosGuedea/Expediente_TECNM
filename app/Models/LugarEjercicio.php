<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: LugarEjercicio
 *  Database alias: Expediente
 *  Table.........: lugar_ejericicio
 *  Table alias...: le
 *  Primary key...: id_lugar_ejercicio

 */
class LugarEjercicio extends AbstractModel
{
    public $id_lugar_ejercicio;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['le' => 'lugar_ejericicio']);

        if (isset($params['id_lugar_ejercicio'
        ])) {
            $query->where('le.id_lugar_ejercicio'
            , $params['id_lugar_ejercicio'
        ]);
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

    public static function insert(LugarEjercicio $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('lugar_ejericicio', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_lugar_ejercicio 
        = $result->getInsertedId();
        return $result;
    }

    public static function update(LugarEjercicio $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('lugar_ejericicio', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

