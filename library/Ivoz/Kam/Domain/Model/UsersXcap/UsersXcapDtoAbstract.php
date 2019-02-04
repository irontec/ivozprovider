<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersXcapDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $doc;

    /**
     * @var integer
     */
    private $docType;

    /**
     * @var string
     */
    private $etag;

    /**
     * @var integer
     */
    private $source;

    /**
     * @var string
     */
    private $docUri;

    /**
     * @var integer
     */
    private $port;

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
            'username' => 'username',
            'domain' => 'domain',
            'doc' => 'doc',
            'docType' => 'docType',
            'etag' => 'etag',
            'source' => 'source',
            'docUri' => 'docUri',
            'port' => 'port',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'doc' => $this->getDoc(),
            'docType' => $this->getDocType(),
            'etag' => $this->getEtag(),
            'source' => $this->getSource(),
            'docUri' => $this->getDocUri(),
            'port' => $this->getPort(),
            'id' => $this->getId()
        ];
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
     * @param string $doc
     *
     * @return static
     */
    public function setDoc($doc = null)
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * @return string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * @param integer $docType
     *
     * @return static
     */
    public function setDocType($docType = null)
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * @param string $etag
     *
     * @return static
     */
    public function setEtag($etag = null)
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @param integer $source
     *
     * @return static
     */
    public function setSource($source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $docUri
     *
     * @return static
     */
    public function setDocUri($docUri = null)
    {
        $this->docUri = $docUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocUri()
    {
        return $this->docUri;
    }

    /**
     * @param integer $port
     *
     * @return static
     */
    public function setPort($port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
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
