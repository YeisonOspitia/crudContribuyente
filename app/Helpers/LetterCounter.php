<?php

namespace App\Helpers;

class LetterCounter
{
    public static function countLetters($string)
    {
        // Convertir a mayúsculas, eliminar espacios y normalizar caracteres especiales
       // $string = strtolower(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $string));
        $string = strtolower(str_replace(' ', '', $string)); 

        $string = preg_replace('/[^\p{L}\p{N}]/u', '', $string);
        $counts = [];
        $length = mb_strlen($string);
        for ($i = 0; $i < $length; $i++) {
            $letter = mb_substr($string, $i, 1);
            if (array_key_exists($letter, $counts)) {
                $counts[$letter]++;
            } else {
                $counts[$letter] = 1;
            }
        }
        return $counts;
    }
}