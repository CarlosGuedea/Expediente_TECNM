<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Digestivo
 *  Database alias: Expediente
 *  Table.........: digestivo
 *  Table alias...: d
 *  Primary key...: id_digestivo
 */
class Digestivo extends AbstractModel
{
    public $id_digestivo;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['d' => 'digestivo']);

        if (isset($params['id_digestivo'])) {
            $query->where('d.id_digestivo', $params['id_digestivo']);
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

    public static function insert(Digestivo $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('digestivo', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_digestivo = $result->getInsertedId();
        return $result;
    }

    public static function update(Digestivo $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('digestivo', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

