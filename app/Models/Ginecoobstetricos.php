<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: Ginecoobstetricos
 *  Database alias: Expediente
 *  Table.........: ginecoobstetricos
 *  Table alias...: g
 *  Primary key...: id_ginecoobstetricos
 */
class Ginecoobstetricos extends AbstractModel
{
    public $id_ginecoobstetricos;
    public $id_historia_medicina;
    public $edad_menarca;
    public $ultima_regla;
    public $ritmo_menstrual;
    public $edad_inicio_vida_sexual;
    public $embarazos;
    public $partos;
    public $abortos;
    public $cesareas;
    public $lactancia_materna;
    public $papanicolaou;
    public $parejas_sexuales;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['g' => 'ginecoobstetricos']);

        if (isset($params['id_ginecoobstetricos'])) {
            $query->where('g.id_ginecoobstetricos', $params['id_ginecoobstetricos']);
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

    public static function insert(Ginecoobstetricos $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('ginecoobstetricos', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_ginecoobstetricos = $result->getInsertedId();
        return $result;
    }

    public static function update(Ginecoobstetricos $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('ginecoobstetricos', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

