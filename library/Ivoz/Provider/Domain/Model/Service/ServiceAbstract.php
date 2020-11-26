<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Service\Name;
use Ivoz\Provider\Domain\Model\Service\Description;

/**
* ServiceAbstract
* @codeCoverageIgnore
*/
abstract class ServiceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden = '';

    /**
     * @var string
     */
    protected $defaultCode;

    /**
     * @var bool
     */
    protected $extraArgs = false;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var Description | null
     */
    protected $description;

    /**
     * Constructor
     */
    protected function __construct(
        $iden,
        $defaultCode,
        $extraArgs,
        Name $name,
        Description $description
    ) {
        $this->setIden($iden);
        $this->setDefaultCode($defaultCode);
        $this->setExtraArgs($extraArgs);
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Service",
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
     * @return ServiceDto
     */
    public static function createDto($id = null)
    {
        return new ServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ServiceInterface|null $entity
     * @param int $depth
     * @return ServiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ServiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ServiceDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ServiceDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $self = new static(
            $dto->getIden(),
            $dto->getDefaultCode(),
            $dto->getExtraArgs(),
            $name,
            $description
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ServiceDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $this
            ->setIden($dto->getIden())
            ->setDefaultCode($dto->getDefaultCode())
            ->setExtraArgs($dto->getExtraArgs())
            ->setName($name)
            ->setDescription($description);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ServiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setDefaultCode(self::getDefaultCode())
            ->setExtraArgs(self::getExtraArgs())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setDescriptionEn(self::getDescription()->getEn())
            ->setDescriptionEs(self::getDescription()->getEs())
            ->setDescriptionCa(self::getDescription()->getCa())
            ->setDescriptionIt(self::getDescription()->getIt());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'defaultCode' => self::getDefaultCode(),
            'extraArgs' => self::getExtraArgs(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'descriptionCa' => self::getDescription()->getCa(),
            'descriptionIt' => self::getDescription()->getIt()
        ];
    }

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return static
     */
    protected function setIden(string $iden): ServiceInterface
    {
        Assertion::maxLength($iden, 50, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set defaultCode
     *
     * @param string $defaultCode
     *
     * @return static
     */
    protected function setDefaultCode(string $defaultCode): ServiceInterface
    {
        Assertion::maxLength($defaultCode, 3, 'defaultCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->defaultCode = $defaultCode;

        return $this;
    }

    /**
     * Get defaultCode
     *
     * @return string
     */
    public function getDefaultCode(): string
    {
        return $this->defaultCode;
    }

    /**
     * Set extraArgs
     *
     * @param bool $extraArgs
     *
     * @return static
     */
    protected function setExtraArgs(bool $extraArgs): ServiceInterface
    {
        Assertion::between(intval($extraArgs), 0, 1, 'extraArgs provided "%s" is not a valid boolean value.');
        $extraArgs = (bool) $extraArgs;

        $this->extraArgs = $extraArgs;

        return $this;
    }

    /**
     * Get extraArgs
     *
     * @return bool
     */
    public function getExtraArgs(): bool
    {
        return $this->extraArgs;
    }

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @return static
     */
    protected function setName(Name $name): ServiceInterface
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @return static
     */
    protected function setDescription(Description $description): ServiceInterface
    {
        $isEqual = $this->description && $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }

}
