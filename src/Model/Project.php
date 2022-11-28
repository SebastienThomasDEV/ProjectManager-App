<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;

class Project extends Model {
    
    private $id;
    private $projectName;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of projectName
     */ 
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set the value of projectName
     *
     * @return  self
     */ 
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }
}
