<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Alcoholismo
 *  Database alias: Expediente
 *  Table.........: alcoholismo
 *  Table alias...: a
 *  Primary key...: id_alcoholismo
 */
class Alcoholismo extends AbstractModel
{
    public $id_alcoholismo;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['a' => 'alcoholismo']);

        if (isset($params['id_alcoholismo'])) {
            $query->where('a.id_alcoholismo', $params['id_alcoholismo']);
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

    public static function insert(Alcoholismo $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('alcoholismo', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_alcoholismo = $result->getInsertedId();
        return $result;
    }

    public static function update(Alcoholismo $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('alcoholismo', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

