<?php

namespace Infrastructure\Entrypoints\Web\Controllers\Dto;

class CreateDocenteRequest
{
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $blog;
    public $profesional;
    public $escalafon;
    public $idioma;
    public $aniosExperiencia;
    public $areaTrabajo;

    public function __construct(
        string $nombre,
        string $apellidos,
        string $email,
        string $telefono,
        string $blog,
        string $profesional,
        string $escalafon,
        string $idioma,
        int    $aniosExperiencia,
        string $areaTrabajo
    ) {
        $this->nombre           = $nombre;
        $this->apellidos        = $apellidos;
        $this->email            = $email;
        $this->telefono         = $telefono;
        $this->blog             = $blog;
        $this->profesional      = $profesional;
        $this->escalafon        = $escalafon;
        $this->idioma           = $idioma;
        $this->aniosExperiencia = $aniosExperiencia;
        $this->areaTrabajo      = $areaTrabajo;
    }
}

class UpdateDocenteRequest
{
    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $blog;
    public $profesional;
    public $escalafon;
    public $idioma;
    public $aniosExperiencia;
    public $areaTrabajo;

    public function __construct(
        int    $id,
        string $nombre,
        string $apellidos,
        string $email,
        string $telefono,
        string $blog,
        string $profesional,
        string $escalafon,
        string $idioma,
        int    $aniosExperiencia,
        string $areaTrabajo
    ) {
        $this->id               = $id;
        $this->nombre           = $nombre;
        $this->apellidos        = $apellidos;
        $this->email            = $email;
        $this->telefono         = $telefono;
        $this->blog             = $blog;
        $this->profesional      = $profesional;
        $this->escalafon        = $escalafon;
        $this->idioma           = $idioma;
        $this->aniosExperiencia = $aniosExperiencia;
        $this->areaTrabajo      = $areaTrabajo;
    }
}

class DocenteResponse
{
    public $id;
    public $nombre;
    public $apellidos;
    public $nombreCompleto;
    public $email;
    public $telefono;
    public $blog;
    public $profesional;
    public $escalafon;
    public $idioma;
    public $aniosExperiencia;
    public $areaTrabajo;

    public function __construct(
        int    $id,
        string $nombre,
        string $apellidos,
        string $nombreCompleto,
        string $email,
        string $telefono,
        string $blog,
        string $profesional,
        string $escalafon,
        string $idioma,
        int    $aniosExperiencia,
        string $areaTrabajo
    ) {
        $this->id               = $id;
        $this->nombre           = $nombre;
        $this->apellidos        = $apellidos;
        $this->nombreCompleto   = $nombreCompleto;
        $this->email            = $email;
        $this->telefono         = $telefono;
        $this->blog             = $blog;
        $this->profesional      = $profesional;
        $this->escalafon        = $escalafon;
        $this->idioma           = $idioma;
        $this->aniosExperiencia = $aniosExperiencia;
        $this->areaTrabajo      = $areaTrabajo;
    }
}
