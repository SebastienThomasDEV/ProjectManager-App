<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;
use Team\Projectbuilder\Model\Project;
use Team\Projectbuilder\Model\User;


class Task extends Model
{

    private $id;
    private $priority;
    private $lifeCycle;
    private $title;
    private $description;
    private $idUser;
    private $idProject;
    private User $user;
    private Project $project;

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
     * Get the value of priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the value of priority
     *
     * @return  self
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of lifeCycle
     */
    public function getLifeCycle()
    {
        return $this->lifeCycle;
    }

    /**
     * Set the value of lifeCycle
     *
     * @return  self
     */
    public function setLifeCycle($lifeCycle)
    {
        $this->lifeCycle = $lifeCycle;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user = NULL)
    {
        if ($this->idUser !== NULL && $user === NULL) {
            $this->user = User::getById($this->idUser);
        }
        if ($user !== NULL) {
            $this->user = $user;
        }

        return $this;
    }

    /**
     * Get the value of project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set the value of project
     *
     * @return  self
     */
    public function setProject($project = NULL)
    {
        if ($this->idProject !== NULL && $project === NULL) {
            $this->project = Project::getById($this->idProject);
        }
        if ($project !== NULL) {
            $this->project = $project;
        }

        return $this;
    }
}
