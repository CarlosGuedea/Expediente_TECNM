<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: PrivRolPermiso
 *  Database alias: default
 *  Table.........: priv_roles_permisos
 *  Table alias...: prp
 *  Primary key...: id_permiso
 */
class PrivRolPermiso extends AbstractModel
{
    public $id_permiso;
    public $id_rol;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['prp' => 'priv_roles_permisos']);

        if (isset($params['id_permiso'])) {
            $query->where('prp.id_permiso', $params['id_permiso']);
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
        $db = DatabaseManager::connect('default');
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

    public static function insert(PrivRolPermiso $data, $columns = null)
    {
        $db = DatabaseManager::connect('default');
        $query = Query::insertInto('priv_roles_permisos', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_permiso = $result->getInsertedId();
        return $result;
    }

    public static function update(PrivRolPermiso $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('default');
        $query = Query::update('priv_roles_permisos', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
