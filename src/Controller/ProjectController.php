<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class ProjectController {

    public function __construct() {
        if (isset($_GET['page'])) {
            $this->createProject();
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
        $view->setVar('projectName',$_POST['projectName']);
    }
    $view->render();
    }

    private function isValid() {
        $return = '';
        $return .= Validate::ValidateNom($_POST['projectName'], 'Project name is not valid<br>');
        return $return;
    }

}