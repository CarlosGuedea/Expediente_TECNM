<?php

namespace App\Models;

use Francerz\SqlBuilder\DatabaseManager;
use Francerz\SqlBuilder\Nesting\NestedSelect;
use Francerz\SqlBuilder\Nesting\NestMode;
use Francerz\SqlBuilder\Nesting\RowProxy;
use Francerz\SqlBuilder\Query;
use Francerz\WebappModelUtils\ModelParams;
use ITColima\SiitecApi\Resources\App\UsuariosResource;

/**
 *  Class.........: Usuario
 *  Database alias: dbdefault
 *  Table.........: usuarios
 *  Table alias...: u
 *  Primary key...: id_usuario
 *
 * @property-read string $nombre_completo
 */
class Usuario extends AbstractModel
{
    public $id_usuario;
    public $usuario;
    public $nombres;
    public $apellido1;
    public $apellido2;
    public $sexo;
    public $tipo_usuario;

    public function __get($name)
    {
        switch ($name) {
            case 'nombre_completo':
                return
                    $this->nombres .
                    (isset($this->apellido1) ? " {$this->apellido1}" : '') .
                    (isset($this->apellido2) ? " {$this->apellido2}" : '');
        }
    }

    public static function getQuery(array $params = [])
    {
        $params = new ModelParams($params);

        $query = Query::selectFrom(['u' => 'usuarios']);

        if (isset($params['id_usuario'])) {
            $query->where('u.id_usuario', $params['id_usuario']);
        }

        if (isset($params['link_perfil'])) {
            $nestQuery = PrivPerfil::getQuery($params->getSubparams('link_perfil'));
            $query->nest(['Perfil' => $nestQuery], function (NestedSelect $nest, RowProxy $row) {
                $nest->getSelect()->where('perfil.id_perfil', $row->id_perfil);
            }, NestMode::SINGLE_FIRST, PrivPerfil::class);
        }

        if (isset($params['nest_permisos'])) {
            $nestQuery = PrivPermiso::getQuery($params->getSubparams('nest_permisos'));
            $query->nest(['Permisos' => $nestQuery], function (NestedSelect $nest, RowProxy $row) {
                $nest->getSelect()->where('pp.id_permiso', $row->id_permiso);
            }, NestMode::COLLECTION, PrivPermiso::class);
        }

        if (isset($params['nest_roles'])) {
            $nestQuery = PrivRol::getQuery($params->getSubparams('nest_roles'));
            $query->nest(['Roles' => $nestQuery], function (NestedSelect $nest, RowProxy $row) {
                $nest->getSelect()->where('pr.id_rol', $row->id_rol);
            }, NestMode::COLLECTION, PrivRol::class);
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

    public static function insert(Usuario $data, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::insertInto('usuarios', $data, $columns);
        $result = $db->executeInsert($query);
        $data->id_usuario = $result->getInsertedId();
        return $result;
    }

    public static function update(Usuario $data, $matching = null, $columns = null)
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::update('usuarios', $data, $matching, $columns);
        $result = $db->executeUpdate($query);
        return $result;
    }

    public static function upsert(Usuario $data, $keys = [], $columns = [])
    {
        $db = DatabaseManager::connect('dbdefault');
        $query = Query::upsert('usuarios', $data, $keys, $columns);
        $result = $db->executeUpsert($query);
        return $result;
    }

    public static function sincronizarId($id_usuario)
    {
        $usuariosRes = new UsuariosResource();
        $usuario = $usuariosRes->getById($id_usuario);

        $usuarioDB = new self();
        $usuarioDB->id_usuario = $usuario->usuario_id;
        $usuarioDB->usuario = $usuario->usuario;
        $usuarioDB->nombres = $usuario->nombres;
        $usuarioDB->apellido1 = $usuario->apellido1;
        $usuarioDB->apellido2 = $usuario->apellido2;
        $usuarioDB->sexo = $usuario->sexo;
        $usuarioDB->tipo_usuario = $usuario->tipo_usuario;
        $result = self::upsert($usuarioDB, ['id_usuario'], [
            'usuario',
            'nombres',
            'apellido1',
            'apellido2',
            'sexo',
            'tipo_usuario'
        ]);
        return $result;
    }
}
