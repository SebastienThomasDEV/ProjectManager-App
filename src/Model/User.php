<?php

namespace Team\Projectbuilder\Model;

use Team\Projectbuilder\Core\Model;

class User extends Model
{
    private $id;
    private $mail;
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
     * Get the value of mail
     */

    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */

    public function setMail($mail)
    {
        $this->mail = $mail;

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
