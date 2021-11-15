<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

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
     * @var string
     */
    protected $doc;

    /**
     * @var int
     * column: doc_type
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
     * @var string
     * column: doc_uri
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
        string $username,
        string $domain,
        string $doc,
        int $docType,
        string $etag,
        int $source,
        string $docUri,
        int $port
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersXcap",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersXcapDto
    {
        return new UsersXcapDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersXcapInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersXcapDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersXcapDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersXcapDto::class);
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
        $doc = $dto->getDoc();
        Assertion::notNull($doc, 'getDoc value is null, but non null value was expected.');
        $docType = $dto->getDocType();
        Assertion::notNull($docType, 'getDocType value is null, but non null value was expected.');
        $etag = $dto->getEtag();
        Assertion::notNull($etag, 'getEtag value is null, but non null value was expected.');
        $source = $dto->getSource();
        Assertion::notNull($source, 'getSource value is null, but non null value was expected.');
        $docUri = $dto->getDocUri();
        Assertion::notNull($docUri, 'getDocUri value is null, but non null value was expected.');
        $port = $dto->getPort();
        Assertion::notNull($port, 'getPort value is null, but non null value was expected.');

        $self = new static(
            $username,
            $domain,
            $doc,
            $docType,
            $etag,
            $source,
            $docUri,
            $port
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersXcapDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersXcapDto::class);

        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
        $doc = $dto->getDoc();
        Assertion::notNull($doc, 'getDoc value is null, but non null value was expected.');
        $docType = $dto->getDocType();
        Assertion::notNull($docType, 'getDocType value is null, but non null value was expected.');
        $etag = $dto->getEtag();
        Assertion::notNull($etag, 'getEtag value is null, but non null value was expected.');
        $source = $dto->getSource();
        Assertion::notNull($source, 'getSource value is null, but non null value was expected.');
        $docUri = $dto->getDocUri();
        Assertion::notNull($docUri, 'getDocUri value is null, but non null value was expected.');
        $port = $dto->getPort();
        Assertion::notNull($port, 'getPort value is null, but non null value was expected.');

        $this
            ->setUsername($username)
            ->setDomain($domain)
            ->setDoc($doc)
            ->setDocType($docType)
            ->setEtag($etag)
            ->setSource($source)
            ->setDocUri($docUri)
            ->setPort($port);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersXcapDto
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

    protected function __toArray(): array
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

    protected function setUsername(string $username): static
    {
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function setDomain(string $domain): static
    {
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    protected function setDoc(string $doc): static
    {
        $this->doc = $doc;

        return $this;
    }

    public function getDoc(): string
    {
        return $this->doc;
    }

    protected function setDocType(int $docType): static
    {
        $this->docType = $docType;

        return $this;
    }

    public function getDocType(): int
    {
        return $this->docType;
    }

    protected function setEtag(string $etag): static
    {
        Assertion::maxLength($etag, 128, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    public function getEtag(): string
    {
        return $this->etag;
    }

    protected function setSource(int $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): int
    {
        return $this->source;
    }

    protected function setDocUri(string $docUri): static
    {
        Assertion::maxLength($docUri, 255, 'docUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->docUri = $docUri;

        return $this;
    }

    public function getDocUri(): string
    {
        return $this->docUri;
    }

    protected function setPort(int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }
}
