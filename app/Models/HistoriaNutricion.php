<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: HistoriaNutricion
 *  Database alias: Expediente
 *  Table.........: hitoria_nutricion
 *  Table alias...: hn
 *  Primary key...: id_historia_nutricion
 */
class HistoriaNutricion extends AbstractModel
{
    public $id_historia_nutricion;
    public $id_estudiante;
    public $fecha;
    public $id_lugar_ejercicio;
    public $id_tiempo_ejercicio;
    public $id_frecuencia_comida;
    public $plan_nutricional;
    public $comida_chatarra;
    public $objetivo;
    public $tiempo_objetivo;
    public $motivo;
    public $realiza_ejercicio;
    public $dias_ejercicio;
    public $id_intensidad_ejercicio;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['hn' => 'hitoria_nutricion']);

        if (isset($params['id_historia_nutricion'])) {
            $query->where('hn.id_historia_nutricion', $params['id_historia_nutricion']);
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

    public static function insert(HistoriaNutricion $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('hitoria_nutricion', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_historia_nutricion = $result->getInsertedId();
        return $result;
    }

    public static function update(HistoriaNutricion $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('hitoria_nutricion', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}
