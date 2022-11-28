<?php

namespace Team\Projectbuilder\Controller;

use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;

class DefaultPage{

    public function __construct()
    {
        $view = new Views('DefaultPage', 'Project Builder');
        if (isset($_POST['submit'])) {
            Security::ConnectUser();
        }
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            $view->setVar('connected', false);
        }
        $view->setVar('message', 'Welcome to project builder');
        $view->render();
    }
}
