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
     * @var \DateTime | string
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
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
            'ruid' => $this->getRuid(),
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'aname' => $this->getAname(),
            'atype' => $this->getAtype(),
            'avalue' => $this->getAvalue(),
            'lastModified' => $this->getLastModified(),
            'id' => $this->getId()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return integer | null
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
     * @return string | null
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
     * @return \DateTime | null
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }
}
