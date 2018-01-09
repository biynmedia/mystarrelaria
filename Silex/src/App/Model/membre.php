<?php

namespace App\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class membre implements UserInterface
{

    private $IDMEMBRE,
            $NOMMEMBRE,
            $PRENOMMEMBRE,
            $EMAILMEMBRE,
            $MDPMEMBRE,
            $ROLEMEMBRE;

    /**
     * membre constructor.
     * @param $IDMEMBRE
     * @param $NOMMEMBRE
     * @param $PRENOMMEMBRE
     * @param $EMAILMEMBRE
     * @param $MDPMEMBRE
     * @param $ROLEMEMBRE
     */
    public function __construct($IDMEMBRE, $NOMMEMBRE, $PRENOMMEMBRE, $EMAILMEMBRE, $MDPMEMBRE, $ROLEMEMBRE)
    {
        $this->IDMEMBRE         = $IDMEMBRE;
        $this->NOMMEMBRE        = $NOMMEMBRE;
        $this->PRENOMMEMBRE     = $PRENOMMEMBRE;
        $this->EMAILMEMBRE      = $EMAILMEMBRE;
        $this->MDPMEMBRE        = $MDPMEMBRE;
        $this->ROLEMEMBRE[]     = $ROLEMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getIDMEMBRE()
    {
        return $this->IDMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getNOMMEMBRE()
    {
        return $this->NOMMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getPRENOMMEMBRE()
    {
        return $this->PRENOMMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getEMAILMEMBRE()
    {
        return $this->EMAILMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->MDPMEMBRE;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->ROLEMEMBRE;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }
    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->EMAILMEMBRE;
    }
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {}

}