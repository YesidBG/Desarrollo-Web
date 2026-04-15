<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteNombreException;

class DocenteNombre
{
    private string $value;

    private function __construct(string $value)
    {
        $trimmed = trim($value);
        if (strlen($trimmed) < 2) {
            throw new InvalidDocenteNombreException("El nombre debe tener al menos 2 caracteres.");
        }
        if (strlen($trimmed) > 100) {
            throw new InvalidDocenteNombreException("El nombre no puede superar 100 caracteres.");
        }
        $this->value = $trimmed;
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
