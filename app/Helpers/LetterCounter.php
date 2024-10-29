<?php

namespace App\Helpers;

class LetterCounter
{
    public static function countLetters($string)
    {
        // Convertir a mayúsculas, eliminar espacios y normalizar caracteres especiales
        $string = strtoupper(str_replace(['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'], ['A', 'E', 'I', 'O', 'U', 'N'], $string));
        $string = preg_replace('/[^A-Z]/', '', $string); // Solo mantener letras

        $counts = [];
        $length = strlen($string);

        for ($i = 0; $i < $length; $i++) {
            $letter = $string[$i];
            if (array_key_exists($letter, $counts)) {
                $counts[$letter]++;
            } else {
                $counts[$letter] = 1;
            }
        }

        return $counts;
    }
}