<?php

namespace Ivoz\Provider\Domain\Model\BrandOperator;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BrandOperatorInterface extends LoggableEntityInterface
{
    public function getChangeSet();

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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

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

