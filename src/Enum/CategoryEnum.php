<?php

namespace App\Enum;

enum CategoryEnum: string
{
    case Professionnel = 'professionnel';
    case Personnel     = 'personnel';
    case Academique    = 'academique';

    public function label(): string
    {
        return match($this) {
            self::Professionnel => 'Professionnel',
            self::Personnel     => 'Personnel',
            self::Academique    => 'Académique',
        };
    }
}
