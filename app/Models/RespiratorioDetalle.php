<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: RespiratorioDetalle
 *  Database alias: Expediente
 *  Table.........: respiratorio_detalle
 *  Table alias...: rd
 *  Primary key...: id_respiratorio_detalle
 */
class RespiratorioDetalle extends AbstractModel
{
    public $id_respiratorio_detalle;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['rd' => 'respiratorio_detalle']);

        if (isset($params['id_respiratorio_detalle'])) {
            $query->where('rd.id_respiratorio_detalle', $params['id_respiratorio_detalle']);
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

    public static function insert(RespiratorioDetalle $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('respiratorio_detalle', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_respiratorio_detalle = $result->getInsertedId();
        return $result;
    }

    public static function update(RespiratorioDetalle $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('respiratorio_detalle', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
