<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Model\isAdmin;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class ProjectController {

    public function __construct() {
        if(isset($_GET['delete'])){
            $this->deleteProject();
        }
        
        if (isset($_GET['insert'])) {
            $this->createProject();
            $this->isAdmin();
        } elseif (isset($_GET['update'])){
            $this->updateProject();
        } else {
            $this->displayProject();
        }
    }

    public function createProject () {
        $view = new Views('CreateProject', 'Project creator');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('submit', 'Create project');
        $view->setVar('message', 'Create a new project');
        $view->setVar('action','&insert=1');
        if (isset($_POST['create'])) {
            if (($message=$this->isValid()) === '') {
                if(Project::create()) {
                    $view->setVar('message','New project created successfully');
                } else {
                    $view->setVar('message', 'Error during project creation!');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $view->render();
    }

    public function displayProject() {
        $view = new Views('DisplayProject','Project list');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $projects = Project::getAll();
        $view->setVar('projects',$projects);
        $view->render();
    }

    private function isValid() {
        $return = '';
        $return .= Validate::ValidateNom($_POST['projectName'], 'Project name is not valid<br>', 'Enter a project name<br>');
        return $return;
    }

    public function updateProject() {
        $view = new Views('CreateProject','Update of project');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('action','&update='.$_GET['update']);
        if (isset($_POST['create'])) {
            if (($message=$this->isValid()) === '') {
                if (Project::updateById()) {
                    $view->setVar('message', 'Project is updated');
                } else {
                    $view->setVar('message', 'Project couldn\'t be updated');
                }
            } else {
                $view->setVar('message',$message);
            }
        }
        $project = Project::getById($_GET['update']);
        $project->setTasks();
        $view->setVar('id',$project->getId());
        $view->setVar('projectName',$project->getProjectName());
        $view->setVar('tasks',$project->getTasks());
        $view->setVar('submit', 'Update');
        $view->render();
}

    public function deleteProject(){
        $project = Project::getById($_GET['delete']);
        $project->setTasks();
        $tasks = $project->getTasks();
        if(count($tasks)!==0){
            foreach ($tasks as $task) {
                $arraytask = (array) $task;
                $id = array_values( $arraytask)[0];
                Task::deleteById($id);
            }
        }
        Project::deleteById($_GET['delete']);
    }

    private function isAdmin() {
        $test = isAdmin::getAll();
        echo "<pre>";
        var_dump($test);
        echo "</pre>";
        // $project = Project::getByAttribute($_POST['projectName'], 'Name of the project is');
    }


}