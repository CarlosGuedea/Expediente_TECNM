<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Tabaquismo
 *  Database alias: Expediente
 *  Table.........: tabaquismo
 *  Table alias...: t
 *  Primary key...: id_tabaquismo
 */
class Tabaquismo extends AbstractModel
{
    public $id_tabaquismo;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['t' => 'tabaquismo']);

        if (isset($params['id_tabaquismo'])) {
            $query->where('t.id_tabaquismo', $params['id_tabaquismo']);
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

    public static function insert(Tabaquismo $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('tabaquismo', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_tabaquismo = $result->getInsertedId();
        return $result;
    }

    public static function update(Tabaquismo $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('tabaquismo', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
