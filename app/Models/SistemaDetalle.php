<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: SistemaDetalle
 *  Database alias: Expediente
 *  Table.........: sistema_detalle
 *  Table alias...: sd
 *  Primary key...: id_sistema_detalle
 */
class SistemaDetalle extends AbstractModel
{
    public $id_sistema_detalle;
    public $id_historia_medicina;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['sd' => 'sistema_detalle']);

        if (isset($params['id_sistema_detalle'])) {
            $query->where('sd.id_sistema_detalle', $params['id_sistema_detalle']);
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

    public static function insert(SistemaDetalle $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('sistema_detalle', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_sistema_detalle = $result->getInsertedId();
        return $result;
    }

    public static function update(SistemaDetalle $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('sistema_detalle', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

