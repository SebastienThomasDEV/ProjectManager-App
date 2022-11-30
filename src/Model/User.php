<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;
use Team\Projectbuilder\Model\Affectation;

class User extends Model
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $pwd;
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
     * Get the value of id
     */

    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }
    /**
     * Get the value of id
     */

    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     */

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pwd
     */

    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */

    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getAffectations()
    {
        return $this->affectations;
    }

    public function setAffectation($affectations=NULL) 
    {
        if ($affectations === NULL) {
            $this->affectations = Affectation::getByAttribute('idUser', $this->id);
        } else {
            $this->affectations = $affectations;
        }

        return $this;
    }

}
