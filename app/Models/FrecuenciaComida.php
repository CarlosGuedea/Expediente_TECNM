<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: FrecuenciaComida
 *  Database alias: Expediente
 *  Table.........: frecuencia_comida
 *  Table alias...: fc
 *  Primary key...: id_frecuencia_comida
 */
class FrecuenciaComida extends AbstractModel
{
    public $id_frecuencia_comida;
    public $nombre;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['fc' => 'frecuencia_comida']);

        if (isset($params['id_frecuencia_comida'])) {
            $query->where('fc.id_frecuencia_comida', $params['id_frecuencia_comida']);
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

    public static function insert(FrecuenciaComida $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('frecuencia_comida', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_frecuencia_comida = $result->getInsertedId();
        return $result;
    }

    public static function update(FrecuenciaComida $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('frecuencia_comida', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

