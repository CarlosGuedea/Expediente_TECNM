<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;

/**
 *  Class.........: HistoriaPiscologica
 *  Database alias: Expediente
 *  Table.........: historia_psicologica
 *  Table alias...: hp
 *  Primary key...: id_historia_psicologica
 */
class HistoriaPiscologica extends AbstractModel
{
    public $id_historia_psicologica;
    public $id_estudiante;
    public $fecha;
    public $derivacion;
    public $problematica;
    public $comportamiento;
    public $tono_voz;
    public $imagen_personal;
    public $dinamica_familiar;
    public $dificultad_academica;
    public $areas_mejora;
    public $trabajo;
    public $tipo_trabajo;
    public $fecha_inicio_trabajo;
    public $experiencia_laboral;
    public $descripcion_personal;
    public $pareja;
    public $tiempo_relacion;
    public $duracion_relaciones;
    public $importacia_relacion;
    public $descripcion_relacion;
    public $descripcion_pareja;
    public $amistades;
    public $relaciones_significativas;
    public $apoyo_amigos;
    public $opinion_amigos_problema;

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['hp' => 'historia_psicologica']);

        if (isset($params['id_historia_psicologica'])) {
            $query->where('hp.id_historia_psicologica', $params['id_historia_psicologica']);
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

    public static function insert(HistoriaPiscologica $data, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::insertInto('historia_psicologica', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_historia_psicologica = $result->getInsertedId();
        return $result;
    }

    public static function update(HistoriaPiscologica $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('Expediente');
        $query = Query::update('historia_psicologica', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }
}

