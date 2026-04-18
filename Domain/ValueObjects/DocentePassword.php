<?php

namespace Domain\ValueObjects;

class DocentePassword
{
    private $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    // Crea desde texto plano — hashea con bcrypt
    public static function fromPlainText(string $plain): self
    {
        if (strlen(trim($plain)) < 4) {
            throw new \RuntimeException("La contraseña debe tener al menos 4 caracteres.");
        }
        return new self(password_hash($plain, PASSWORD_BCRYPT));
    }

    // Crea desde hash guardado en BD
    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    // Verifica si un texto plano coincide con el hash
    public function verifyPlain(string $plain): bool
    {
        return password_verify($plain, $this->hash);
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}