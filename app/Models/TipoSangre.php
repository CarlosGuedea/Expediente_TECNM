<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: TipoSangre
 *  Database alias: Expediente
 *  Table.........: tipo_sangre
 *  Table alias...: ts
 *  Primary key...: id_tipo_saangre
 */
class TipoSangre extends AbstractModel
{
    public $id_tipo_saangre;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['ts' => 'tipo_sangre']);

        if (isset($params['id_tipo_saangre'])) {
            $query->where('ts.id_tipo_saangre', $params['id_tipo_saangre']);
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

    public static function insert(TipoSangre $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('tipo_sangre', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_tipo_saangre = $result->getInsertedId();
        return $result;
    }

    public static function update(TipoSangre $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('tipo_sangre', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

