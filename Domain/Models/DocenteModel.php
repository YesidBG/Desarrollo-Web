<?php

namespace Domain\Models;

use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteNombre;
use Domain\ValueObjects\DocenteEmail;
use Domain\ValueObjects\DocenteTelefono;
use Domain\ValueObjects\DocenteBlog;
use Domain\ValueObjects\DocenteAniosExperiencia;
use Domain\Enums\EscalafonDocente;
use Domain\Enums\IdiomaDocente;

class DocenteModel
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $blog;
    private $profesional;
    private $escalafon;
    private $idioma;
    private $aniosExperiencia;
    private $areaTrabajo;

    private function __construct(
        $id,
        DocenteNombre           $nombre,
        DocenteNombre           $apellidos,
        DocenteEmail            $email,
        DocenteTelefono         $telefono,
        DocenteBlog             $blog,
        string                  $profesional,
        EscalafonDocente        $escalafon,
        IdiomaDocente           $idioma,
        DocenteAniosExperiencia $aniosExperiencia,
        string                  $areaTrabajo
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

    public static function create(
        $id,
        DocenteNombre           $nombre,
        DocenteNombre           $apellidos,
        DocenteEmail            $email,
        DocenteTelefono         $telefono,
        DocenteBlog             $blog,
        string                  $profesional,
        EscalafonDocente        $escalafon,
        IdiomaDocente           $idioma,
        DocenteAniosExperiencia $aniosExperiencia,
        string                  $areaTrabajo
    ): self {
        return new self(
            $id, $nombre, $apellidos, $email, $telefono,
            $blog, $profesional, $escalafon, $idioma,
            $aniosExperiencia, $areaTrabajo
        );
    }

    public function getId()                         { return $this->id; }
    public function getNombre(): DocenteNombre      { return $this->nombre; }
    public function getApellidos(): DocenteNombre   { return $this->apellidos; }
    public function getEmail(): DocenteEmail        { return $this->email; }
    public function getTelefono(): DocenteTelefono  { return $this->telefono; }
    public function getBlog(): DocenteBlog          { return $this->blog; }
    public function getProfesional(): string        { return $this->profesional; }
    public function getEscalafon(): EscalafonDocente{ return $this->escalafon; }
    public function getIdioma(): IdiomaDocente      { return $this->idioma; }
    public function getAniosExperiencia(): DocenteAniosExperiencia { return $this->aniosExperiencia; }
    public function getAreaTrabajo(): string        { return $this->areaTrabajo; }

    public function getNombreCompleto(): string
    {
        return $this->nombre->value() . ' ' . $this->apellidos->value();
    }
}
