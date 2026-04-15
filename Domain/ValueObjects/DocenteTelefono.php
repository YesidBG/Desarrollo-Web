<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteTelefonoException;

class DocenteTelefono
{
    private string $value;

    private function __construct(string $value)
    {
        $trimmed = trim($value);
        // Permite formatos: +57 3001234567, 3001234567, (604)1234567, etc.
        if (!preg_match('/^[\+]?[\d\s\(\)\-]{7,20}$/', $trimmed)) {
            throw new InvalidDocenteTelefonoException("El teléfono '$trimmed' no tiene un formato válido.");
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
