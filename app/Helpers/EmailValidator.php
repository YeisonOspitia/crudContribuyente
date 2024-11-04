<?php

namespace App\Helpers;

class EmailValidator
{
    public static function isValidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { return false; }
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(gov|edu|org|mil|int|.gov.co)$/i', $email);
    }
}