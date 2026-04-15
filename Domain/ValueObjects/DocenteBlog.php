<?php

namespace Domain\ValueObjects;

use Domain\Exceptions\InvalidDocenteBlogException;

class DocenteBlog
{
    private ?string $value;

    private function __construct(?string $value)
    {
        if ($value === null || trim($value) === '') {
            $this->value = null;
            return;
        }
        $trimmed = trim($value);
        if (!filter_var($trimmed, FILTER_VALIDATE_URL)) {
            throw new InvalidDocenteBlogException("La URL del blog '$trimmed' no es válida.");
        }
        $this->value = $trimmed;
    }

    public static function from(?string $value): self
    {
        return new self($value);
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
