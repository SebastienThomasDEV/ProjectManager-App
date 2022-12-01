<?php

namespace Team\Projectbuilder\Core;

use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\Project;

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
            $array_user = (array) $user;
            foreach ($array_user as $key) {
                if ($mail === $key) {
                    $return = 'Email is already used';
                }
            }
        }
        return $return;
    }

    public static function newTask($task)
    {
        $return = '';
        $Tasks = Task::getAll();
        foreach ($Tasks as $task) {
            $array_task = (array) $task;
            foreach ($array_task as $key) {
                if ($task === $key) {
                    $return = 'Task title is already used';
                }
            }
        }
        return $return;
    }

    public static function existingProject($projectname)
    {
        $return = '';
        $projects= Project::getAll();
        foreach ($projects as $project) {
            $array_project = (array) $project;
            foreach ($array_project as $key) {
                if ($projectname === $key) {
                    $return = "The name $projectname is already used, enter a new project name";
                }
            }
        }
        return $return;
    }


    public static function addUserToProject($mail) {
        $return = 'User does not exist';
        $users = User::getAll();
        foreach ($users as $user) {
            $array_user = (array) $user;
            foreach ($array_user as $key) {
                if ($mail === $key) {
                    $return = '';
                }
            }
        }
        return $return;
    }
}