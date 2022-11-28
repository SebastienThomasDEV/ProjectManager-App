<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;

class User extends Model
{
    private $id;
    private $email;
    private $pwd;

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
}
