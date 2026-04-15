<?php

namespace Domain\Exceptions;

// ── Excepciones de Value Objects ──────────────────────────────────────────────

class InvalidDocenteIdException extends \RuntimeException {}

class InvalidDocenteNombreException extends \RuntimeException {}

class InvalidDocenteEmailException extends \RuntimeException {}

class InvalidDocenteTelefonoException extends \RuntimeException {}

class InvalidDocenteBlogException extends \RuntimeException {}

class InvalidDocenteAniosExperienciaException extends \RuntimeException {}

// ── Excepciones de negocio ────────────────────────────────────────────────────

class DocenteNotFoundException extends \RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct("No se encontró ningún docente con ID $id.");
    }
}

class DocenteEmailDuplicadoException extends \RuntimeException
{
    public function __construct(string $email)
    {
        parent::__construct("Ya existe un docente registrado con el email '$email'.");
    }
}
