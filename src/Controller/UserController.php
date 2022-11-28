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
        $view = new Views('createuser', 'Création d\'un compte');
        if (isset($_POST['submit'])) {
            if (($message = $this->isValid()) === '') {
                unset($_POST['submit']);
                unset($_POST['pwdconfirm']);
                $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                if (User::create()) {
                    $view->setVar('message', "L'utilisateur a bien été créé");
                } else {
                    $view->setVar('message', 'Une erreur est survenue');
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
            'Le nom n\'est pas correct <br>',
            'le champ nom ne peut pas être vide <br>'
        );
        $return .= Validate::ValidateNom(
            $_POST['firstname'],
            'Le prénom n\'est pas correct <br>',
            'le champ prenom ne peut pas être vide <br>'
        );
        $return .= Validate::ValidateEmail($_POST['email']);
        $return .= Validate::verifyConfirmPassword(
            $_POST['pwd'],
            $_POST['pwdconfirm']
        );
        return $return;
    }
}
