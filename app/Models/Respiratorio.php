<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Respiratorio
 *  Database alias: Expediente
 *  Table.........: respiratorio
 *  Table alias...: r
 *  Primary key...: id_respiratorio
 */
class Respiratorio extends AbstractModel
{
    public $id_respiratorio;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['r' => 'respiratorio']);

        if (isset($params['id_respiratorio'])) {
            $query->where('r.id_respiratorio', $params['id_respiratorio']);
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

    public static function insert(Respiratorio $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('respiratorio', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_respiratorio = $result->getInsertedId();
        return $result;
    }

    public static function update(Respiratorio $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('respiratorio', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
