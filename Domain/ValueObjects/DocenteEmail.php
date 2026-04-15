<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteEmailException;

class DocenteEmail
{
    private string $value;

    private function __construct(string $value)
    {
        $trimmed = trim($value);
        if (!filter_var($trimmed, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidDocenteEmailException("El email '$trimmed' no es válido.");
        }
        $this->value = strtolower($trimmed);
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
