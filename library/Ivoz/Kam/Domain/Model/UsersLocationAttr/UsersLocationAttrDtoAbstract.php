<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersLocationAttrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ruid = '';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $aname = '';

    /**
     * @var integer
     */
    private $atype = 0;

    /**
     * @var string
     */
    private $avalue = '';

    /**
     * @var \DateTime
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var integer
     */
    private $id;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'ruid' => 'ruid',
            'username' => 'username',
            'domain' => 'domain',
            'aname' => 'aname',
            'atype' => 'atype',
            'avalue' => 'avalue',
            'lastModified' => 'lastModified',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'ruid' => $this->getRuid(),
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'aname' => $this->getAname(),
            'atype' => $this->getAtype(),
            'avalue' => $this->getAvalue(),
            'lastModified' => $this->getLastModified(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $ruid
     *
     * @return static
     */
    public function setRuid($ruid = null)
    {
        $this->ruid = $ruid;

        return $this;
    }

    /**
     * @return string
     */
    public function getRuid()
    {
        return $this->ruid;
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername($username = null)
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
     * @param string $domain
     *
     * @return static
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $aname
     *
     * @return static
     */
    public function setAname($aname = null)
    {
        $this->aname = $aname;

        return $this;
    }

    /**
     * @return string
     */
    public function getAname()
    {
        return $this->aname;
    }

    /**
     * @param integer $atype
     *
     * @return static
     */
    public function setAtype($atype = null)
    {
        $this->atype = $atype;

        return $this;
    }

    /**
     * @return integer
     */
    public function getAtype()
    {
        return $this->atype;
    }

    /**
     * @param string $avalue
     *
     * @return static
     */
    public function setAvalue($avalue = null)
    {
        $this->avalue = $avalue;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvalue()
    {
        return $this->avalue;
    }

    /**
     * @param \DateTime $lastModified
     *
     * @return static
     */
    public function setLastModified($lastModified = null)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
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
}
