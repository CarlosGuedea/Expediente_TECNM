<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: PrivUsuarioRol
 *  Database alias: dbdefault
 *  Table.........: priv_usuarios_roles
 *  Table alias...: pur
 *  Primary key...: id_usuario
 */
class PrivUsuarioRol extends AbstractModel
{
    public $id_usuario;
    public $id_rol;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['pur' => 'priv_usuarios_roles']);

        if (isset($params['id_usuario'])) {
            $query->where('pur.id_usuario', $params['id_usuario']);
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

    public static function insert(PrivUsuarioRol $data, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::insertInto('priv_usuarios_roles', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_usuario = $result->getInsertedId();
        return $result;
    }

    public static function update(PrivUsuarioRol $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::update('priv_usuarios_roles', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
