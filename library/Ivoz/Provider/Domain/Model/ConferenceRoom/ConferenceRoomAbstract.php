<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* ConferenceRoomAbstract
* @codeCoverageIgnore
*/
abstract class ConferenceRoomAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $pinProtected = false;

    /**
     * @var string | null
     */
    protected $pinCode;

    /**
     * @var int
     */
    protected $maxMembers = 0;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $pinProtected,
        $maxMembers
    ) {
        $this->setName($name);
        $this->setPinProtected($pinProtected);
        $this->setMaxMembers($maxMembers);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConferenceRoom",
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
     * @return ConferenceRoomDto
     */
    public static function createDto($id = null)
    {
        return new ConferenceRoomDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ConferenceRoomInterface|null $entity
     * @param int $depth
     * @return ConferenceRoomDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConferenceRoomInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ConferenceRoomDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConferenceRoomDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConferenceRoomDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getPinProtected(),
            $dto->getMaxMembers()
        );

        $self
            ->setPinCode($dto->getPinCode())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConferenceRoomDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConferenceRoomDto::class);

        $this
            ->setName($dto->getName())
            ->setPinProtected($dto->getPinProtected())
            ->setPinCode($dto->getPinCode())
            ->setMaxMembers($dto->getMaxMembers())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConferenceRoomDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setPinProtected(self::getPinProtected())
            ->setPinCode(self::getPinCode())
            ->setMaxMembers(self::getMaxMembers())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'pinProtected' => self::getPinProtected(),
            'pinCode' => self::getPinCode(),
            'maxMembers' => self::getMaxMembers(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): ConferenceRoomInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set pinProtected
     *
     * @param bool $pinProtected
     *
     * @return static
     */
    protected function setPinProtected(bool $pinProtected): ConferenceRoomInterface
    {
        Assertion::between(intval($pinProtected), 0, 1, 'pinProtected provided "%s" is not a valid boolean value.');
        $pinProtected = (bool) $pinProtected;

        $this->pinProtected = $pinProtected;

        return $this;
    }

    /**
     * Get pinProtected
     *
     * @return bool
     */
    public function getPinProtected(): bool
    {
        return $this->pinProtected;
    }

    /**
     * Set pinCode
     *
     * @param string $pinCode | null
     *
     * @return static
     */
    protected function setPinCode(?string $pinCode = null): ConferenceRoomInterface
    {
        if (!is_null($pinCode)) {
            Assertion::maxLength($pinCode, 6, 'pinCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pinCode = $pinCode;

        return $this;
    }

    /**
     * Get pinCode
     *
     * @return string | null
     */
    public function getPinCode(): ?string
    {
        return $this->pinCode;
    }

    /**
     * Set maxMembers
     *
     * @param int $maxMembers
     *
     * @return static
     */
    protected function setMaxMembers(int $maxMembers): ConferenceRoomInterface
    {
        Assertion::greaterOrEqualThan($maxMembers, 0, 'maxMembers provided "%s" is not greater or equal than "%s".');

        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * Get maxMembers
     *
     * @return int
     */
    public function getMaxMembers(): int
    {
        return $this->maxMembers;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): ConferenceRoomInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

}
