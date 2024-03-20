<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: PrivPerfil
 *  Database alias: dbdefault
 *  Table.........: priv_perfiles
 *  Table alias...: perfil
 *  Primary key...: id_perfil
 */
class PrivPerfil extends AbstractModel
{
    public $id_perfil;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['perfil' => 'priv_perfiles']);

        if (isset($params['id_perfil'])) {
            $query->where('perfil.id_perfil', $params['id_perfil']);
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

    public static function insert(PrivPerfil $data, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::insertInto('priv_perfiles', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_perfil = $result->getInsertedId();
        return $result;
    }

    public static function update(PrivPerfil $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::update('priv_perfiles', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
