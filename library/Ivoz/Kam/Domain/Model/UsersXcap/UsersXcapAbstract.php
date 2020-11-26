<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersXcapAbstract
* @codeCoverageIgnore
*/
abstract class UsersXcapAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var 
     */
    protected $doc;

    /**
     * column: doc_type
     * @var int
     */
    protected $docType;

    /**
     * @var string
     */
    protected $etag;

    /**
     * @var int
     */
    protected $source;

    /**
     * column: doc_uri
     * @var string
     */
    protected $docUri;

    /**
     * @var int
     */
    protected $port;

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
     * @param UsersXcapInterface|null $entity
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

        /** @var UsersXcapDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersXcapDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersXcapDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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

    /**
     * Set username
     *
     * @param string $username
     *
     * @return static
     */
    protected function setUsername(string $username): UsersXcapInterface
    {
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return static
     */
    protected function setDomain(string $domain): UsersXcapInterface
    {
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Set doc
     *
     * @param  $doc
     *
     * @return static
     */
    protected function setDoc( $doc): UsersXcapInterface
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * Get doc
     *
     * @return 
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * Set docType
     *
     * @param int $docType
     *
     * @return static
     */
    protected function setDocType(int $docType): UsersXcapInterface
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * Get docType
     *
     * @return int
     */
    public function getDocType(): int
    {
        return $this->docType;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return static
     */
    protected function setEtag(string $etag): UsersXcapInterface
    {
        Assertion::maxLength($etag, 64, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string
    {
        return $this->etag;
    }

    /**
     * Set source
     *
     * @param int $source
     *
     * @return static
     */
    protected function setSource(int $source): UsersXcapInterface
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return int
     */
    public function getSource(): int
    {
        return $this->source;
    }

    /**
     * Set docUri
     *
     * @param string $docUri
     *
     * @return static
     */
    protected function setDocUri(string $docUri): UsersXcapInterface
    {
        Assertion::maxLength($docUri, 255, 'docUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->docUri = $docUri;

        return $this;
    }

    /**
     * Get docUri
     *
     * @return string
     */
    public function getDocUri(): string
    {
        return $this->docUri;
    }

    /**
     * Set port
     *
     * @param int $port
     *
     * @return static
     */
    protected function setPort(int $port): UsersXcapInterface
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

}
