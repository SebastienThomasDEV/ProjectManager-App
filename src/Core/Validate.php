<?php
namespace Team\Projectbuilder\Core;

abstract class Validate {

    public static function ValidateNom($nom, $message) {
        $return = '';
        $pattern ="/^([a-zA-Z' -]+)$/";
        if (!preg_match($pattern, $nom)) {
            $return = $message;
        }
        return $return;
    }

    public static function ValidateEmail($mail) {
        $return = '';
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $return = 'The mail is not correct<br>';
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