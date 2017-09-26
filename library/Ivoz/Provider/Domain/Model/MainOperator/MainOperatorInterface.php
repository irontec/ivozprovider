<?php

namespace Ivoz\Provider\Domain\Model\MainOperator;

use Ivoz\Core\Domain\Model\EntityInterface;

interface MainOperatorInterface extends EntityInterface
{
    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return self
     */
    public function setPass($pass);

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return self
     */
    public function setActive($active);

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname = null);

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname();

    /**
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone
     *
     * @return self
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null);

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

}

