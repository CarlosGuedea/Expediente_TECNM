<?php

namespace App;

use Francerz\WebappCommons\AbstractSession;
use ITColima\SiitecApi\Model\Perfil;

final class Session extends AbstractSession
{
    /**
     * @param Perfil $perfil
     * @return void
     */
    public static function setPerfil(Perfil $perfil)
    {
        static::set('siitec-api.perfil', $perfil);
    }
    /**
     * @return Perfil|null
     */
    public static function getPerfil()
    {
        return static::get('siitec-api.perfil');
    }
}
