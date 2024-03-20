<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: PrivPerfilPermiso
 *  Database alias: dbdefault
 *  Table.........: priv_perfiles_permisos
 *  Table alias...: pp
 *  Primary key...: id_permiso
 */
class PrivPerfilPermiso extends AbstractModel
{
    public $id_permiso;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['pp' => 'priv_perfiles_permisos']);

        if (isset($params['id_permiso'])) {
            $query->where('pp.id_permiso', $params['id_permiso']);
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

    public static function insert(PrivPerfilPermiso $data, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::insertInto('priv_perfiles_permisos', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_permiso = $result->getInsertedId();
        return $result;
    }

    public static function update(PrivPerfilPermiso $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::update('priv_perfiles_permisos', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
