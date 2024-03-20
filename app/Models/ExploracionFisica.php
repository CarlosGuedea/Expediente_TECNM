<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: ExploracionFisica
 *  Database alias: Expediente
 *  Table.........: exploracion_fisica
 *  Table alias...: ef
 *  Primary key...: id_exploracion_fisica
 */
class ExploracionFisica extends AbstractModel
{
    public $id_exploracion_fisica;
    public $id_historia_medicina;
    public $presion_arterial;
    public $frecuencia_cardiaca;
    public $temperatura;
    public $peso;
    public $talla;
    public $imc;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['ef' => 'exploracion_fisica']);

        if (isset($params['id_exploracion_fisica'])) {
            $query->where('ef.id_exploracion_fisica', $params['id_exploracion_fisica']);
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

    public static function insert(ExploracionFisica $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('exploracion_fisica', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_exploracion_fisica = $result->getInsertedId();
        return $result;
    }

    public static function update(ExploracionFisica $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('exploracion_fisica', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

