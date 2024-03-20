<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Urinario
 *  Database alias: Expediente
 *  Table.........: urinario
 *  Table alias...: u
 *  Primary key...: id_urinario
 */
class Urinario extends AbstractModel
{
    public $id_urinario;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['u' => 'urinario']);

        if (isset($params['id_urinario'])) {
            $query->where('u.id_urinario', $params['id_urinario']);
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

    public static function insert(Urinario $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('urinario', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_urinario = $result->getInsertedId();
        return $result;
    }

    public static function update(Urinario $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('urinario', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

