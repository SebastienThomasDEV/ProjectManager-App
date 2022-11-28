<?php
namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Core\Validate;

class UserController
{
    public function __construct()
    {
        $this->createUser();
    }

    public function createUser()
    {
        $view = new Views('createuser', 'User Creation');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        if (isset($_POST['submit'])) {
            if (($message = $this->isValid()) === '') {
                unset($_POST['submit']);
                unset($_POST['pwdconfirm']);
                $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                if (User::create()) {
                    $view->setVar('message', "The account has been created successfully");
                } else {
                    $view->setVar('message', 'Error during user creation');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $view->render();
    }
    private function isValid()
    {

        $return = '';
        $return .= Validate::ValidateNom(
            $_POST['lastname'],
            'Last name is not correct <br>',
            'The field "last name" cannot be empty <br>'
        );
        $return .= Validate::ValidateNom(
            $_POST['firstname'],
            'First name is not correct <br>',
            'The field "first name" cannot be empty <br>'
        );
        $return .= Validate::ValidateEmail($_POST['email']);
        $return .= Validate::verifyConfirmPassword(
            $_POST['pwd'],
            $_POST['pwdconfirm']
        );
        $return .= Validate::passwordLength($_POST['pwd']);

        $return .= User::newEmail($_POST['email']);
        return $return;
    }
}
