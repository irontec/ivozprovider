<?php

namespace Ivoz\Provider\Domain\Model\MainOperator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class MainOperatorDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var string
     */
    private $email = '';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $timezoneId;

    /**
     * @var mixed
     */
    private $timezone;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'username' => $this->getUsername(),
            'pass' => $this->getPass(),
            'email' => $this->getEmail(),
            'active' => $this->getActive(),
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'id' => $this->getId(),
            'timezoneId' => $this->getTimezoneId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->timezone = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Timezone\\Timezone', $this->getTimezoneId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $username
     *
     * @return MainOperatorDTO
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $pass
     *
     * @return MainOperatorDTO
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $email
     *
     * @return MainOperatorDTO
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param boolean $active
     *
     * @return MainOperatorDTO
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $name
     *
     * @return MainOperatorDTO
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $lastname
     *
     * @return MainOperatorDTO
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param integer $id
     *
     * @return MainOperatorDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $timezoneId
     *
     * @return MainOperatorDTO
     */
    public function setTimezoneId($timezoneId)
    {
        $this->timezoneId = $timezoneId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimezoneId()
    {
        return $this->timezoneId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\Timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}

