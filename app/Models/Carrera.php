<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Carrera
 *  Database alias: Expediente
 *  Table.........: carrera
 *  Table alias...: c
 *  Primary key...: id_carrera
 */
class Carrera extends AbstractModel
{
    public $id_carrera;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['c' => 'carrera']);

        if (isset($params['id_carrera'])) {
            $query->where('c.id_carrera', $params['id_carrera']);
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

    public static function insert(Carrera $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('carrera', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_carrera = $result->getInsertedId();
        return $result;
    }

    public static function update(Carrera $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('carrera', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
