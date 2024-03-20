<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Familia
 *  Database alias: Expediente
 *  Table.........: Familia
 *  Table alias...: f
 *  Primary key...: id_familia
 */
class Familia extends AbstractModel
{
    public $id_familia;
    public $id_historia_psicologica;
    public $nombre;
    public $parentesco;
    public $relacion;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['f' => 'Familia']);

        if (isset($params['id_familia'])) {
            $query->where('f.id_familia', $params['id_familia']);
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

    public static function insert(Familia $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('Familia', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_familia = $result->getInsertedId();
        return $result;
    }

    public static function update(Familia $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('Familia', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

