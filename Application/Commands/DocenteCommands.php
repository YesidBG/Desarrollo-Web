<?php

namespace Application\Commands;

// ── Command: Crear Docente ─────────────────────────────────────────────────────
/**
 * Transporta todos los datos necesarios para crear un docente.
 * Es un objeto de datos puro (no contiene lógica).
 */
class CreateDocenteCommand
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

// ── Command: Actualizar Docente ───────────────────────────────────────────────
class UpdateDocenteCommand
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

// ── Command: Eliminar Docente ─────────────────────────────────────────────────
class DeleteDocenteCommand
{
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}

// ── Command: Login ────────────────────────────────────────────────────────
class LoginCommand
{
    public $email;
    public $password;

    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }
}

// ── Command: Recuperar contraseña ─────────────────────────────────────────
class ForgotPasswordCommand
{
    public $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
