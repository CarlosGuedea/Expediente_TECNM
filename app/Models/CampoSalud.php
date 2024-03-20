<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: CampoSalud
 *  Database alias: expediente
 *  Table.........: campo_salud
 *  Table alias...: cs
 *  Primary key...: id_campo_salud
 */
class CampoSalud extends AbstractModel
{
    public $id_campo_salud;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['cs' => 'campo_salud']);

        if (isset($params['id_campo_salud'])) {
            $query->where('cs.id_campo_salud', $params['id_campo_salud']);
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

    public static function insert(CampoSalud $data, $columns = null)
    {
        $db = DatabaseManager::connect('expediente');
        $query = Query::insertInto('campo_salud', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_campo_salud = $result->getInsertedId();
        return $result;
    }

    public static function update(CampoSalud $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('expediente');
        $query = Query::update('campo_salud', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

