<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Model\User;



class Affectation extends Model {
    private $idUser;
    private $idProject;


    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of idProject
     */ 
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * Set the value of idProject
     *
     * @return  self
     */ 
    public function setIdProject($idProject)
    {
        $this->idProject = $idProject;

        return $this;
    }

    
}
