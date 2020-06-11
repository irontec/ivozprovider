<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * PublicEntityAbstract
 * @codeCoverageIgnore
 */
abstract class PublicEntityAbstract
{
    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string | null
     */
    protected $fqdn;

    /**
     * @var boolean
     */
    protected $platform = false;

    /**
     * @var boolean
     */
    protected $brand = false;

    /**
     * @var boolean
     */
    protected $client = false;

    /**
     * @var Name | null
     */
    protected $name;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $iden,
        $platform,
        $brand,
        $client,
        Name $name
    ) {
        $this->setIden($iden);
        $this->setPlatform($platform);
        $this->setBrand($brand);
        $this->setClient($client);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "PublicEntity",
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
     * @return PublicEntityDto
     */
    public static function createDto($id = null)
    {
        return new PublicEntityDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param PublicEntityInterface|null $entity
     * @param int $depth
     * @return PublicEntityDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PublicEntityInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var PublicEntityDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PublicEntityDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, PublicEntityDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $self = new static(
            $dto->getIden(),
            $dto->getPlatform(),
            $dto->getBrand(),
            $dto->getClient(),
            $name
        );

        $self
            ->setFqdn($dto->getFqdn())
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PublicEntityDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, PublicEntityDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $this
            ->setIden($dto->getIden())
            ->setFqdn($dto->getFqdn())
            ->setPlatform($dto->getPlatform())
            ->setBrand($dto->getBrand())
            ->setClient($dto->getClient())
            ->setName($name);



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return PublicEntityDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setFqdn(self::getFqdn())
            ->setPlatform(self::getPlatform())
            ->setBrand(self::getBrand())
            ->setClient(self::getClient())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'fqdn' => self::getFqdn(),
            'platform' => self::getPlatform(),
            'brand' => self::getBrand(),
            'client' => self::getClient(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return static
     */
    protected function setIden($iden)
    {
        Assertion::notNull($iden, 'iden value "%s" is null, but non null value was expected.');
        Assertion::maxLength($iden, 100, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden(): string
    {
        return $this->iden;
    }

    /**
     * Set fqdn
     *
     * @param string $fqdn | null
     *
     * @return static
     */
    protected function setFqdn($fqdn = null)
    {
        if (!is_null($fqdn)) {
            Assertion::maxLength($fqdn, 200, 'fqdn value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fqdn = $fqdn;

        return $this;
    }

    /**
     * Get fqdn
     *
     * @return string | null
     */
    public function getFqdn()
    {
        return $this->fqdn;
    }

    /**
     * Set platform
     *
     * @param boolean $platform
     *
     * @return static
     */
    protected function setPlatform($platform)
    {
        Assertion::notNull($platform, 'platform value "%s" is null, but non null value was expected.');
        Assertion::between(intval($platform), 0, 1, 'platform provided "%s" is not a valid boolean value.');
        $platform = (bool) $platform;

        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return boolean
     */
    public function getPlatform(): bool
    {
        return $this->platform;
    }

    /**
     * Set brand
     *
     * @param boolean $brand
     *
     * @return static
     */
    protected function setBrand($brand)
    {
        Assertion::notNull($brand, 'brand value "%s" is null, but non null value was expected.');
        Assertion::between(intval($brand), 0, 1, 'brand provided "%s" is not a valid boolean value.');
        $brand = (bool) $brand;

        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return boolean
     */
    public function getBrand(): bool
    {
        return $this->brand;
    }

    /**
     * Set client
     *
     * @param boolean $client
     *
     * @return static
     */
    protected function setClient($client)
    {
        Assertion::notNull($client, 'client value "%s" is null, but non null value was expected.');
        Assertion::between(intval($client), 0, 1, 'client provided "%s" is not a valid boolean value.');
        $client = (bool) $client;

        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return boolean
     */
    public function getClient(): bool
    {
        return $this->client;
    }

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\PublicEntity\Name $name
     *
     * @return static
     */
    protected function setName(Name $name)
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\Name
     */
    public function getName()
    {
        return $this->name;
    }
    // @codeCoverageIgnoreEnd
}
