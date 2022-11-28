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

        if($nom !== $pattern){
            $return = 'it\'s not a name';
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
            $return = 'The password is not valid <br>';
        }
        if(strlen($pwd) < 4){
            $return = 'The password must be composed of at least 4 characters <br>';
        return $return;
        }
    }
}