<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: HistoriaMedicina
 *  Database alias: Expediente
 *  Table.........: historia_medicina
 *  Table alias...: hm
 *  Primary key...: id_historia_medicina
 */
class HistoriaMedicina extends AbstractModel
{
    public $id_historia_medicina;
    public $id_estudiante;
    public $fecha;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['hm' => 'historia_medicina']);

        if (isset($params['id_historia_medicina'])) {
            $query->where('hm.id_historia_medicina', $params['id_historia_medicina']);
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

    public static function insert(HistoriaMedicina $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('historia_medicina', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_historia_medicina = $result->getInsertedId();
        return $result;
    }

    public static function update(HistoriaMedicina $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('historia_medicina', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
