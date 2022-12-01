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
        if(isset($_GET['delete'])) {
            User::deleteById((int) $_GET['delete']);
            session_destroy();
        }
        if (isset($_GET['insert'])) {
            $this->createUser();
        } elseif(isset($_GET['updatepwd'])){
            $this->updatePwd();
        } elseif(isset($_GET['update'])){
        
            $this->updateUser();
        }
        else {
            $this->displayUser();
        }
    }

    public function createUser()
    {
        $view = new Views('CreateUser', 'User Creation');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            $view->setVar('connected', false);
        }
        $view->setVar('submit', 'Create account');
        $view->setVar('action','&insert=1');
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

    public function displayUser(){
        $view = new Views ('DisplayUser', 'Your account');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $users = User::getById($_SESSION['id']);
        $view -> setVar('users', $users);
        $view -> render();
    }

    public function updateUser(){
        $view = new Views ('CreateUser', 'Modify account');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('submit', 'Update user');
        $view->setVar('action','&update='.$_GET['update']);
        if (isset($_POST['submit'])) {
            if (($message=$this->isValid()) === '') {
                unset($_POST['submit']);
                if (User::updateById()) {
                    $view->setVar('message', 'The account has been updated');
                } else {
                    $view->setVar('message', 'The update could not be done');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $user = User::getById($_GET['update']);
        $view->setVar('firstName',$user->getFirstName());
        $view->setVar('lastName',$user->getLastName());
        $view->setVar('email',$user->getEmail());
        $view->render();
    }

    public function updatePwd(){
        $view = new Views ('CreateUser', 'Modify password');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('submit', 'Update password');
        $view->setVar('action','&updatepwd='.$_GET['updatepwd']);
        if (isset($_POST['submit'])) {
            if (($message=$this->isValid()) === '') {
                unset($_POST['submit']);
                unset($_POST['pwdconfirm']);
                unset($_POST['oldpwd']);
                $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                if (User::updateById()) {
                    $view->setVar('message', 'The password has been changed');
                } else {
                    $view->setVar('message', 'Your password couldn\'t be changed. Make sure the old password you typed is correct and that the new password meets the minimum security requirements.');
                }
            } else {
                $test = $this->isValid();
                $view->setVar('message', $message);
            }
        }
        $view->render();
    }

    private function isValid()
    {
        $return = '';
        if (isset($_GET['update'])){
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
            if($_SESSION['email']!=$_POST['email']){
                $return .= Validate::ValidateEmail($_POST['email']);
                $return .= Validate::newEmail($_POST['email']);    
            }
            
        }

        if (isset($_GET['insert'])){
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
                $return .= Validate::newEmail($_POST['email']);    
            
            
        }

        if (isset($_GET['updatepwd'])){
            $user = User::getById($_GET['updatepwd']);
            $oldPwd = $user->getPwd();
            $return .= Validate::verifyUpdatePassword(
                $_POST['oldpwd'],
                $oldPwd
            );
            $return .= Validate::verifyConfirmPassword(
                $_POST['pwd'],
                $_POST['pwdconfirm']
            );
            $return .= Validate::passwordLength($_POST['pwd']);
        }
        return $return;
    }
}
