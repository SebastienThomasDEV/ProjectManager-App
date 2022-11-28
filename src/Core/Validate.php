<?php

namespace Team\Projectbuilder\Core;

abstract class Validate
{
    public static function ValidateNom($nom, $message, $messagevide)
    {
        $return = '';
        $pattern = "/^([a-zA-Z' -]+)$/";
        if ($nom === '') {
            if (!preg_match($pattern, $nom)) {
                $return = $messagevide;
            }
        } else {
            if (!preg_match($pattern, $nom)) {
                $return = $message;
            }
        }
        return $return;
    }

    public static function ValidateEmail($email)
    {
        $return = '';
        if ($email === '') {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $return = 'Le mail ne peut pas être vide <br>';
            }
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $return = 'Le mail est incorrecte <br>';
            }
        }
        return $return;
    }

    public static function verifyConfirmPassword($pwd, $pwdconfirm)
    {
        $return = '';
        if ($pwd !== $pwdconfirm) {
            $return = 'Les champs mot de passe sont différent';
        }
        return $return;
    }
}
