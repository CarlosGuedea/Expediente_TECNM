<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: EstadoCivil
 *  Database alias: Expediente
 *  Table.........: estado_civil
 *  Table alias...: ec
 *  Primary key...: id_estado_civil
 */
class EstadoCivil extends AbstractModel
{
    public $id_estado_civil;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['ec' => 'estado_civil']);

        if (isset($params['id_estado_civil'])) {
            $query->where('ec.id_estado_civil', $params['id_estado_civil']);
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

    public static function insert(EstadoCivil $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('estado_civil', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_estado_civil = $result->getInsertedId();
        return $result;
    }

    public static function update(EstadoCivil $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('estado_civil', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

