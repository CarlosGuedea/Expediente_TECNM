<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: PrivRol
 *  Database alias: dbdefault
 *  Table.........: priv_roles
 *  Table alias...: pr
 *  Primary key...: id_rol
 */
class PrivRol extends AbstractModel
{
    public $id_rol;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['pr' => 'priv_roles']);

        if (isset($params['id_rol'])) {
            $query->where('pr.id_rol', $params['id_rol']);
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
        $db = DatabaseManager::connect('dbdefault');
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

    public static function insert(PrivRol $data, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::insertInto('priv_roles', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_rol = $result->getInsertedId();
        return $result;
    }

    public static function update(PrivRol $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::update('priv_roles', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
