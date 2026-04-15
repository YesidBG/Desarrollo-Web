<?php

namespace Domain\Enums;

enum IdiomaDocente: string
{
    case ESPANOL  = 'Español';
    case INGLES   = 'Inglés';
    case FRANCES  = 'Francés';
    case ALEMAN   = 'Alemán';
    case PORTUGUES = 'Portugués';
    case MANDARIN = 'Mandarín';
    case OTRO     = 'Otro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
