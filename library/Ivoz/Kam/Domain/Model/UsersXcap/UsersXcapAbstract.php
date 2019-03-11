<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * column: doc_type
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
     * column: doc_uri
     * @var string
     */
    protected $docUri;

    /**
     * @var integer
     */
    protected $port;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersXcap",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return UsersXcapDto
     */
    public static function createDto($id = null)
    {
        return new UsersXcapDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return UsersXcapDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersXcapInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersXcapDto
         */
        Assertion::isInstanceOf($dto, UsersXcapDto::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getDomain(),
            $dto->getDoc(),
            $dto->getDocType(),
            $dto->getEtag(),
            $dto->getSource(),
            $dto->getDocUri(),
            $dto->getPort()
        );

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersXcapDto
         */
        Assertion::isInstanceOf($dto, UsersXcapDto::class);

        $this
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setDoc($dto->getDoc())
            ->setDocType($dto->getDocType())
            ->setEtag($dto->getEtag())
            ->setSource($dto->getSource())
            ->setDocUri($dto->getDocUri())
            ->setPort($dto->getPort());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersXcapDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setDoc(self::getDoc())
            ->setDocType(self::getDocType())
            ->setEtag(self::getEtag())
            ->setSource(self::getSource())
            ->setDocUri(self::getDocUri())
            ->setPort(self::getPort());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'doc' => self::getDoc(),
            'doc_type' => self::getDocType(),
            'etag' => self::getEtag(),
            'source' => self::getSource(),
            'doc_uri' => self::getDocUri(),
            'port' => self::getPort()
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
    protected function setUsername($username)
    {
        Assertion::notNull($username, 'username value "%s" is null, but non null value was expected.');
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setDomain($domain)
    {
        Assertion::notNull($domain, 'domain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setDoc($doc)
    {
        Assertion::notNull($doc, 'doc value "%s" is null, but non null value was expected.');

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
    protected function setDocType($docType)
    {
        Assertion::notNull($docType, 'docType value "%s" is null, but non null value was expected.');
        Assertion::integerish($docType, 'docType value "%s" is not an integer or a number castable to integer.');

        $this->docType = (int) $docType;

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
    protected function setEtag($etag)
    {
        Assertion::notNull($etag, 'etag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($etag, 64, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setSource($source)
    {
        Assertion::notNull($source, 'source value "%s" is null, but non null value was expected.');
        Assertion::integerish($source, 'source value "%s" is not an integer or a number castable to integer.');

        $this->source = (int) $source;

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
    protected function setDocUri($docUri)
    {
        Assertion::notNull($docUri, 'docUri value "%s" is null, but non null value was expected.');
        Assertion::maxLength($docUri, 255, 'docUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setPort($port)
    {
        Assertion::notNull($port, 'port value "%s" is null, but non null value was expected.');
        Assertion::integerish($port, 'port value "%s" is not an integer or a number castable to integer.');

        $this->port = (int) $port;

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
