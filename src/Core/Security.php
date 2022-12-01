<?php

namespace Team\Projectbuilder\Core;

use Team\Projectbuilder\Model\User;

class Security
{
    public static function isConnected()
    {
        if (session_status() != 2) {
            session_start();
        }
        if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
            return true;
        }
        session_destroy();
        return false;
    }

    public static function ConnectUser()
    {
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        $searchUser = User::getByAttribute('email', $user);
        $idUser = $searchUser[0]->getId();
        $firstname = $searchUser[0]->getfirstName();
        $email = $searchUser[0]->getEmail();
        
        if (
            $user === $searchUser[0]->getEmail() &&
            password_verify($_POST['pwd'], $searchUser[0]->getPwd())
        ) {
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['id'] = $idUser;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['email'] = $email;
        }
    }
}

