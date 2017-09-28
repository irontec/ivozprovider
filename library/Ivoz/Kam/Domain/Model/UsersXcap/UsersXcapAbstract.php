<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UsersXcapAbstract
 * @codeCoverageIgnore
 */
abstract class UsersXcapAbstract
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $doc;

    /**
     * @column doc_type
     * @var integer
     */
    protected $docType;

    /**
     * @var string
     */
    protected $etag;

    /**
     * @var integer
     */
    protected $source;

    /**
     * @column doc_uri
     * @var string
     */
    protected $docUri;

    /**
     * @var integer
     */
    protected $port;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $username,
        $domain,
        $doc,
        $docType,
        $etag,
        $source,
        $docUri,
        $port
    ) {
        $this->setUsername($username);
        $this->setDomain($domain);
        $this->setDoc($doc);
        $this->setDocType($docType);
        $this->setEtag($etag);
        $this->setSource($source);
        $this->setDocUri($docUri);
        $this->setPort($port);
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return UsersXcapDTO
     */
    public static function createDTO()
    {
        return new UsersXcapDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersXcapDTO
         */
        Assertion::isInstanceOf($dto, UsersXcapDTO::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getDomain(),
            $dto->getDoc(),
            $dto->getDocType(),
            $dto->getEtag(),
            $dto->getSource(),
            $dto->getDocUri(),
            $dto->getPort());

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersXcapDTO
         */
        Assertion::isInstanceOf($dto, UsersXcapDTO::class);

        $this
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setDoc($dto->getDoc())
            ->setDocType($dto->getDocType())
            ->setEtag($dto->getEtag())
            ->setSource($dto->getSource())
            ->setDocUri($dto->getDocUri())
            ->setPort($dto->getPort());


        return $this;
    }

    /**
     * @return UsersXcapDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setUsername($this->getUsername())
            ->setDomain($this->getDomain())
            ->setDoc($this->getDoc())
            ->setDocType($this->getDocType())
            ->setEtag($this->getEtag())
            ->setSource($this->getSource())
            ->setDocUri($this->getDocUri())
            ->setPort($this->getPort());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'doc' => $this->getDoc(),
            'docType' => $this->getDocType(),
            'etag' => $this->getEtag(),
            'source' => $this->getSource(),
            'docUri' => $this->getDocUri(),
            'port' => $this->getPort()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        Assertion::notNull($username);
        Assertion::maxLength($username, 64);

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain)
    {
        Assertion::notNull($domain);
        Assertion::maxLength($domain, 190);

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set doc
     *
     * @param string $doc
     *
     * @return self
     */
    public function setDoc($doc)
    {
        Assertion::notNull($doc);

        $this->doc = $doc;

        return $this;
    }

    /**
     * Get doc
     *
     * @return string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * Set docType
     *
     * @param integer $docType
     *
     * @return self
     */
    public function setDocType($docType)
    {
        Assertion::notNull($docType);
        Assertion::integerish($docType);

        $this->docType = $docType;

        return $this;
    }

    /**
     * Get docType
     *
     * @return integer
     */
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return self
     */
    public function setEtag($etag)
    {
        Assertion::notNull($etag);
        Assertion::maxLength($etag, 64);

        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * Set source
     *
     * @param integer $source
     *
     * @return self
     */
    public function setSource($source)
    {
        Assertion::notNull($source);
        Assertion::integerish($source);

        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return integer
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set docUri
     *
     * @param string $docUri
     *
     * @return self
     */
    public function setDocUri($docUri)
    {
        Assertion::notNull($docUri);
        Assertion::maxLength($docUri, 255);

        $this->docUri = $docUri;

        return $this;
    }

    /**
     * Get docUri
     *
     * @return string
     */
    public function getDocUri()
    {
        return $this->docUri;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port)
    {
        Assertion::notNull($port);
        Assertion::integerish($port);

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }



    // @codeCoverageIgnoreEnd
}

