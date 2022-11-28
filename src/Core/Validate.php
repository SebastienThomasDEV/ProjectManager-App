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
                $return = 'This field cannot be empty <br>';
            }
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $return = 'Mail is not valid <br>';
            }
        }
        return $return;
    }


    public static function verifyConfirmPassword($pwd,$pwdConfirm) {
        $return = '';
        if ($pwd !== $pwdConfirm) {
            $return = 'The password is not valid';
        }
        return $return;
    }
}