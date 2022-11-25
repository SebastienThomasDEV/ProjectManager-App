<?php

namespace Team\Projectbuilder\Core;

use Team\Projectbuilder\Controller\DefaultPage;
use Team\Projectbuilder\Controller\ProjectController;
use Team\Projectbuilder\Core\Security;

class Dispatcher
{
    public function __construct()
    {
        if (isset($_GET['session'])) {
            session_start();
            session_destroy();
            header('location: index.php');
        }
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'createproject':
                    new ProjectController();
                    break;
                default:
                    new DefaultPage();
                    break;
            }
        } else {
            new DefaultPage();
        }
    }
}
