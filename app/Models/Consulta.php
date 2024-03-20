<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Consulta
 *  Database alias: expediente
 *  Table.........: consultas
 *  Table alias...: c
 *  Primary key...: id_consulta
 */
class Consulta extends AbstractModel
{
    public $id_consulta;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['c' => 'consultas']);

        if (isset($params['id_consulta'])) {
            $query->where('c.id_consulta', $params['id_consulta']);
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
        $db = DatabaseManager::connect('expediente');
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

    public static function insert(Consulta $data, $columns = null)
    {
        $db = DatabaseManager::connect('expediente');
        $query = Query::insertInto('consultas', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_consulta = $result->getInsertedId();
        return $result;
    }

    public static function update(Consulta $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('expediente');
        $query = Query::update('consultas', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

