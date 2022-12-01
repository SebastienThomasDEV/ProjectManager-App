<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Model\Affectation;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class ProjectController
{

    public function __construct()
    {
        if (isset($_GET['delete'])) {
            $this->deleteProject();
        }

        if (isset($_GET['insert'])) {
            $this->createProject();
        } elseif (isset($_GET['update'])) {
            $this->updateProject();
        } else {
            $this->displayProject();
        }
    }

    public function createProject()
    {
        $view = new Views('CreateProject', 'Project creator');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('submit', 'Create project');
        $view->setVar('message', 'Create a new project');
        $view->setVar('action', '&insert=1');
        if (isset($_POST['create'])) {
            if (($message = $this->isValid()) === '') {
                if (Project::create()) {
                    $view->setVar('message', 'New project created successfully');
                    $project = Project::getByAttribute('projectName', $_POST['projectName']);
                    $idProject = $project[0]->getId();
                    Affectation::createAffectation($idProject);
                } else {
                    $view->setVar('message', 'Error during project creation!');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $view->render();
    }

    public function displayProject()
    {
        $view = new Views('DisplayProject', 'Projects you created'); //title in projects tab
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $projects = Project::getByAttribute('idAdmin', $_SESSION['id']);
        $user = User::getById($_SESSION['id']);
        $projectsMemberId = $this->displayOtherProjects($user);
        $projectsParticipant = [];
        foreach ($projectsMemberId as $projectid) {
            $projectsParticipant[] = Project::getById($projectid);
        }
        $view->setVar('projects', $projects);
        $view->setVar('projectsParticipant', $projectsParticipant);
        $view->render();
    }

    private function isValid()
    {
        $return = '';
        $return .= Validate::existingProject($_POST['projectName']);
        return $return;
    }

    public function updateProject()
    {
        $view = new Views('CreateProject', 'Update of project');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar('action', '&update=' . $_GET['update']);
        if (isset($_POST['create'])) {
            if (($message = $this->isValid()) === '') {
                if (Project::updateById()) {
                    $view->setVar('message', 'Project is updated');
                } else {
                    $view->setVar('message', 'Project couldn\'t be updated');
                }
            } else {
                $view->setVar('message', $message);
            }
        }
        $project = Project::getById($_GET['update']);
        $project->setTasks();
        $view->setVar('id', $project->getId());
        $view->setVar('projectName', $project->getProjectName());
        $view->setVar('tasks', $project->getTasks());
        $view->setVar('submit', 'Update');
        $view->render();
    }

    //a ameliorer, surement pas besoin de foreach (voire fonction deleteAffectationFromProject dans Model.php)
    public function deleteProject()
    {
        $project = Project::getById($_GET['delete']);
        $project->setAffectation();
        $affectations = $project->getAffectations();
        if (count($affectations) !== 0) {
            foreach ($affectations as $affectation) {
                $array_affectation = (array) $affectation;
                $id = array_values($array_affectation)[1];
                Affectation::deleteAffectationFromProject($id);
            }
        }
        Project::deleteById($_GET['delete']);
    }

    public function displayOtherProjects($user)
    {
        $user = User::getById($_SESSION['id']);
        $user->setAffectation();
        $return = [];
        foreach ($user->getAffectations() as $affectation) {
            $return[] = $affectation->getIdProject();
        }
        return $return;
    }
}
