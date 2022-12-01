<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;
use Team\Projectbuilder\Model\Task;
use Team\Projectbuilder\Model\User;
use Team\Projectbuilder\Model\Affectation;
use Team\Projectbuilder\Core\Security;
use Team\Projectbuilder\Core\Views;
use Team\Projectbuilder\Core\Validate;

class Project extends Model
{

    private $id;
    private $projectName;
    private $idAdmin;
    private array $tasks;
    private array $affectations;

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

    /**
     * Get the value of tasks
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    public function getAffectations()
    {
        return $this->affectations;
    }

    /**
     * Set the value of tasks
     *
     * @return  self
     */
    public function setTasks($tasks = NULL)
    {
        if ($tasks === NULL) {
            $this->tasks = Task::getByAttribute('idProject', $this->id);
        } else {
            $this->tasks = $tasks;
        }

        return $this;
    }

    public function setAffectation($affectations = NULL)
    {
        if ($affectations === NULL) {
            $this->affectations = Affectation::getByAttribute('idProject', $this->id);
        } else {
            $this->affectations = $affectations;
        }

        return $this;
    }

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }
}
