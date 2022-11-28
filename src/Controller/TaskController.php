<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class TaskController
{

    public function __construct()
    {
        if (isset($_GET['insert'])) {
            $this->createTask();
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
        $view->setVar('submit', 'Create new task');
        $view->setVar('message', 'Task list');
        //$tasks = Task::getAll();
        $project = Project::getById($_GET['idproject']);
        $project->setTasks();
        foreach ($project->getTasks() as $task) {
            $task->setUser();
        }
        //$task->setProject();
        $view->setVar('project', $project);
        $view->render();
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
            $view->setVar('title', $_POST['title']);
            $view->setVar('description', $_POST['description']);
            $view->setVar('priority', $_POST['priority']);
            $view->setVar('lifeCycle', $_POST['lifecycle']);
            $view->setVar('idUser', 'NULL');
            $view->setVar('idProject', $_GET['idproject']);
        }
        $view->render();
    }

    private function isValid()
    {
        $return = '';
        $return .= Validate::ValidateNom($_POST['title'], 'Task title is not valid<br>', 'Enter a task title<br>');
        return $return;
    }
}
