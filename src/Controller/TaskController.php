<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Model\Affectation;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class TaskController
{

    public function __construct()
    {
        if (isset($_GET['delete'])) {
            Task::deleteById((int)$_GET['delete']);
        }

        if (isset($_GET['updatetask']) && $_POST['users_list'] !== '') {
            $user = User::getByAttribute('email', $_POST['users_list'])[0]->getId();
            Task::updateAssignedUser($user, $_GET['updatetask']);
        }
        if (isset($_GET['insert'])) {
            $this->createTask();
        } else if (isset($_GET['update'])) {
            $this->updateTask();
        } else {
            $this->displayTask();
        }
    }

    public function displayTask()
    {
        $view = new Views('DisplayTask', 'Task list');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        if (isset($_POST['adduser']) && $_POST['email'] !== '') {
            $adduser = $this->addUserToProject($_POST['email']);
            $view->setVar('message', $adduser);
        }
        $view->setVar('submit', 'Create new task');
        $project = Project::getById($_GET['idproject']);
        $project->setTasks();
        foreach ($project->getTasks() as $task) {
            $task->setUser();
        }
        $idAdmin = $project->getIdAdmin();
        $projectsMemberId = $this->displayProjectUsers($project);
        $users = [];
        $isConnectedUseraMember = FALSE;
        foreach ($projectsMemberId as $userid) {
            if ($userid === $_SESSION['id']) {
                $isConnectedUseraMember = TRUE;
            }
            $users[] = User::getById($userid);
        }
        if ($isConnectedUseraMember) {
            $view->setVar('idAdmin', $idAdmin);
            $view->setVar('project', $project);
            $view->setVar('users', $users);
            $view->render();
        }
    }

    public function createTask()
    {
        $view = new Views('CreateTask', 'Task manager');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('submit', 'Create task');
        $view->setVar('message', 'Create a new task');

        if (isset($_POST['create'])) {
            if (($message = $this->isValid()) === '') {
                if (Task::create()) {
                    $view->setVar('message', 'New task created successfully',);
                } else {
                    $view->setVar('message', 'Error during task creation!');
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
        if (isset($_POST['adduser'])) {
            $return .= Validate::addUserToProject($_POST['email']);
        } else {
            $return .= Validate::newTask($_POST['title'], 'Task title is already used<br>', 'Enter an other task title<br>');
        }
        return $return;
    }




    public function updateTask()
    {
        $view = new Views('CreateTask', 'Update an task');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('action', '&update=' . $_GET['update']);
        if (isset($_POST['create'])) {
            if ($message = $this->isValid() === '') {
                if (Task::updateById()) {
                    $view->setVar('message', 'Task updated succesfully');
                } else {
                    $view->setVar('message', 'An error has occured');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $task = Task::getById($_GET['update']);
        $view->setVar('title', $task->getTitle());
        $view->setVar('description', $task->getDescription());
        $view->setVar('priority', $task->getPriority());
        $view->setVar('lifeCycle', $task->getLifeCycle());
        $view->setVar('submit', 'update');
        $view->render();
    }

    public function displayProjectUsers($project)
    {
        $project = Project::getById($_GET['idproject']);
        $project->setAffectation();
        $return = [];
        foreach ($project->getAffectations() as $affectation) {
            $return[] = $affectation->getIdUser();
        }
        return $return;
    }

    public function addUserToProject($email)
    {   
        $return = '';
        $idUser = User::getByAttribute('email', $email)[0]->getId();
        $verifs=Affectation::getAll();
        $alreadyAssigned= FALSE;
        foreach($verifs as $verif){
            if($verif->getIdUser()==$idUser && $verif->getIdProject()==$_GET['idproject']){
                $alreadyAssigned= TRUE;
            }
        }
        if (isset($_POST['adduser']) && $alreadyAssigned != TRUE ) {
            if ($message = $this->isValid() === '') {
                if (Task::addUser($idUser, $_GET['idproject'])) {
                    $return = 'User added succesfully';
                } else {
                    $return = 'An error has occured';
                }
            }
        }else {
            $return = 'User is already assigned to this project';
            return $return;
        }
        return $return;
    }

    
}
