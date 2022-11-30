<?php

namespace Team\Projectbuilder\Core;

use Team\Projectbuilder\Core\User;

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
            $return = 'The passwords are not the same <br>';
        }
        return $return;
    }

    public static function passwordLength($pwd) {
        $return = '';
        if(strlen($pwd) < 4){
            $return = 'The password must be composed of at least 4 characters <br>';
        }
        return $return;
    }

    public static function verifyUpdatePassword($pwd,$pwdConfirm) {
        $return = '';
        $verif = password_verify($pwd, $pwdConfirm);
        if ($verif !== TRUE) {
            $return = 'Your current password is incorrect. Try again<br>';
        }
        return $return;
    }
    
    public static function newEmail($mail)
    {
        $return = '';
        $users = User::getAll();
        foreach ($users as $user) {
            $userarr = (array) $user;
            foreach ($userarr as $key) {
                if ($mail === $key) {
                    $return = 'Email is already used';
                }
            }
        }
        return $return;
    }
}