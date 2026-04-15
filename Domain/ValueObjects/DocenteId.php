<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteIdException;

class DocenteId
{
    private int $value;

    private function __construct(int $value)
    {
        if ($value <= 0) {
            throw new InvalidDocenteIdException("El ID del docente debe ser un número positivo.");
        }
        $this->value = $value;
    }

    public static function from(int $value): self
    {
        return new self($value);
    }

    public static function fromNullable(?int $value): ?self
    {
        if ($value === null) return null;
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
