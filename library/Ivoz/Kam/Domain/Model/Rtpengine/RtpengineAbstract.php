<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet;

/**
* RtpengineAbstract
* @codeCoverageIgnore
*/
abstract class RtpengineAbstract
{
    use ChangelogTrait;

    protected $setid = 0;

    protected $url;

    protected $weight = 1;

    protected $disabled = false;

    protected $stamp;

    protected $description;

    /**
     * @var MediaRelaySetInterface | null
     */
    protected $mediaRelaySet;

    /**
     * Constructor
     */
    protected function __construct(
        int $setid,
        string $url,
        int $weight,
        bool $disabled,
        \DateTimeInterface|string $stamp
    ) {
        $this->setSetid($setid);
        $this->setUrl($url);
        $this->setWeight($weight);
        $this->setDisabled($disabled);
        $this->setStamp($stamp);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Rtpengine",
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
     */
    public static function createDto($id = null): RtpengineDto
    {
        return new RtpengineDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RtpengineInterface|null $entity
     * @param int $depth
     * @return RtpengineDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RtpengineInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var RtpengineDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RtpengineDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RtpengineDto::class);

        $self = new static(
            $dto->getSetid(),
            $dto->getUrl(),
            $dto->getWeight(),
            $dto->getDisabled(),
            $dto->getStamp()
        );

        $self
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($fkTransformer->transform($dto->getMediaRelaySet()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RtpengineDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RtpengineDto::class);

        $this
            ->setSetid($dto->getSetid())
            ->setUrl($dto->getUrl())
            ->setWeight($dto->getWeight())
            ->setDisabled($dto->getDisabled())
            ->setStamp($dto->getStamp())
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($fkTransformer->transform($dto->getMediaRelaySet()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): RtpengineDto
    {
        return self::createDto()
            ->setSetid(self::getSetid())
            ->setUrl(self::getUrl())
            ->setWeight(self::getWeight())
            ->setDisabled(self::getDisabled())
            ->setStamp(self::getStamp())
            ->setDescription(self::getDescription())
            ->setMediaRelaySet(MediaRelaySet::entityToDto(self::getMediaRelaySet(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'setid' => self::getSetid(),
            'url' => self::getUrl(),
            'weight' => self::getWeight(),
            'disabled' => self::getDisabled(),
            'stamp' => self::getStamp(),
            'description' => self::getDescription(),
            'mediaRelaySetId' => self::getMediaRelaySet() ? self::getMediaRelaySet()->getId() : null
        ];
    }

    protected function setSetid(int $setid): static
    {
        $this->setid = $setid;

        return $this;
    }

    public function getSetid(): int
    {
        return $this->setid;
    }

    protected function setUrl(string $url): static
    {
        Assertion::maxLength($url, 64, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    protected function setWeight(int $weight): static
    {
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    protected function setDisabled(bool $disabled): static
    {
        Assertion::between((int) $disabled, 0, 1, 'disabled provided "%s" is not a valid boolean value.');
        $disabled = (bool) $disabled;

        $this->disabled = $disabled;

        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    protected function setStamp($stamp): static
    {

        $stamp = DateTimeHelper::createOrFix(
            $stamp,
            '2000-01-01 00:00:00'
        );

        if ($this->stamp == $stamp) {
            return $this;
        }

        $this->stamp = $stamp;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getStamp(): \DateTimeInterface
    {
        return clone $this->stamp;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 200, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    public function getMediaRelaySet(): ?MediaRelaySetInterface
    {
        return $this->mediaRelaySet;
    }
}
