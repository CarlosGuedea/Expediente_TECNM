<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: DigestivoDetalle
 *  Database alias: Expediente
 *  Table.........: digestivo_detalle
 *  Table alias...: dd
 *  Primary key...: id_digestivo_detalle
 */
class DigestivoDetalle extends AbstractModel
{
    public $id_digestivo_detalle;
    public $id_sistema_detalle;
    public $id_digestivo;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['dd' => 'digestivo_detalle']);

        if (isset($params['id_digestivo_detalle'])) {
            $query->where('dd.id_digestivo_detalle', $params['id_digestivo_detalle']);
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

    public static function insert(DigestivoDetalle $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('digestivo_detalle', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_digestivo_detalle = $result->getInsertedId();
        return $result;
    }

    public static function update(DigestivoDetalle $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('digestivo_detalle', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
