<?php

namespace Domain\Enums;

enum EscalafonDocente: string
{
    case INSTRUCTOR = 'Instructor';
    case ASISTENTE = 'Asistente';
    case ASOCIADO = 'Asociado';
    case TITULAR = 'Titular';
    case EMERITO = 'Emérito';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
