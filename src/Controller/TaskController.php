<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class TaskController {

    public function __construct() {
        $this-> displayTask();
    }

    public function displayTask() {
        $view= new Views('DisplayTask', 'Task list');
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
        $view->setVar('project',$project);
        $view->render();
    }

}