<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: UrinarioDetalle
 *  Database alias: Expediente
 *  Table.........: urinario_detalle
 *  Table alias...: ud
 *  Primary key...: id_urinario_detalle
 */
class UrinarioDetalle extends AbstractModel
{
    public $id_urinario_detalle;
    public $id_sistema_detalle;
    public $id_urinario;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['ud' => 'urinario_detalle']);

        if (isset($params['id_urinario_detalle'])) {
            $query->where('ud.id_urinario_detalle', $params['id_urinario_detalle']);
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

    public static function insert(UrinarioDetalle $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('urinario_detalle', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_urinario_detalle = $result->getInsertedId();
        return $result;
    }

    public static function update(UrinarioDetalle $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('urinario_detalle', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

