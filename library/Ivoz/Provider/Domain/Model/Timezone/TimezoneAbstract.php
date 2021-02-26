<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Timezone\Label;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* TimezoneAbstract
* @codeCoverageIgnore
*/
abstract class TimezoneAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tz;

    /**
     * @var string | null
     */
    protected $comment = '';

    /**
     * @var Label | null
     */
    protected $label;

    /**
     * @var CountryInterface | null
     */
    protected $country;

    /**
     * Constructor
     */
    protected function __construct(
        $tz,
        Label $label
    ) {
        $this->setTz($tz);
        $this->setLabel($label);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Timezone",
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
     * @param mixed $id
     * @return TimezoneDto
     */
    public static function createDto($id = null)
    {
        return new TimezoneDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TimezoneInterface|null $entity
     * @param int $depth
     * @return TimezoneDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TimezoneInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TimezoneDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TimezoneDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TimezoneDto::class);

        $label = new Label(
            $dto->getLabelEn(),
            $dto->getLabelEs(),
            $dto->getLabelCa(),
            $dto->getLabelIt()
        );

        $self = new static(
            $dto->getTz(),
            $label
        );

        $self
            ->setComment($dto->getComment())
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TimezoneDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TimezoneDto::class);

        $label = new Label(
            $dto->getLabelEn(),
            $dto->getLabelEs(),
            $dto->getLabelCa(),
            $dto->getLabelIt()
        );

        $this
            ->setTz($dto->getTz())
            ->setComment($dto->getComment())
            ->setLabel($label)
            ->setCountry($fkTransformer->transform($dto->getCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TimezoneDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTz(self::getTz())
            ->setComment(self::getComment())
            ->setLabelEn(self::getLabel()->getEn())
            ->setLabelEs(self::getLabel()->getEs())
            ->setLabelCa(self::getLabel()->getCa())
            ->setLabelIt(self::getLabel()->getIt())
            ->setCountry(Country::entityToDto(self::getCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tz' => self::getTz(),
            'comment' => self::getComment(),
            'labelEn' => self::getLabel()->getEn(),
            'labelEs' => self::getLabel()->getEs(),
            'labelCa' => self::getLabel()->getCa(),
            'labelIt' => self::getLabel()->getIt(),
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null
        ];
    }

    protected function setTz(string $tz): static
    {
        Assertion::maxLength($tz, 255, 'tz value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tz = $tz;

        return $this;
    }

    public function getTz(): string
    {
        return $this->tz;
    }

    protected function setComment(?string $comment = null): static
    {
        if (!is_null($comment)) {
            Assertion::maxLength($comment, 150, 'comment value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->comment = $comment;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getLabel(): Label
    {
        return $this->label;
    }

    protected function setLabel(Label $label): static
    {
        $isEqual = $this->label && $this->label->equals($label);
        if ($isEqual) {
            return $this;
        }

        $this->label = $label;
        return $this;
    }

    protected function setCountry(?CountryInterface $country = null): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryInterface
    {
        return $this->country;
    }

}
