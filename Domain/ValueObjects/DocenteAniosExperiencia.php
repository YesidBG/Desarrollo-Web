<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteAniosExperienciaException;

class DocenteAniosExperiencia
{
    private int $value;

    private function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidDocenteAniosExperienciaException("Los años de experiencia no pueden ser negativos.");
        }
        if ($value > 60) {
            throw new InvalidDocenteAniosExperienciaException("Los años de experiencia no pueden superar 60.");
        }
        $this->value = $value;
    }

    public static function from(int $value): self
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
