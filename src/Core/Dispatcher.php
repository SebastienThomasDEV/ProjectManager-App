<?php

namespace Team\Projectbuilder\Core;

use Team\Projectbuilder\Controller\DefaultPage;
use Team\Projectbuilder\Controller\ElevesController;
use Team\Projectbuilder\Controller\UserController;
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
                case 'createuser':
                    new UserController();
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
