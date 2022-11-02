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

    /**
     * @var int
     */
    protected $setid = 0;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $weight = 1;

    /**
     * @var bool
     */
    protected $disabled = false;

    /**
     * @var \DateTime
     */
    protected $stamp;

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * @var ?MediaRelaySetInterface
     */
    protected $mediaRelaySet = null;

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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Rtpengine",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RtpengineDto
    {
        return new RtpengineDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RtpengineInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RtpengineDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RtpengineDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RtpengineDto::class);
        $setid = $dto->getSetid();
        Assertion::notNull($setid, 'getSetid value is null, but non null value was expected.');
        $url = $dto->getUrl();
        Assertion::notNull($url, 'getUrl value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $disabled = $dto->getDisabled();
        Assertion::notNull($disabled, 'getDisabled value is null, but non null value was expected.');
        $stamp = $dto->getStamp();
        Assertion::notNull($stamp, 'getStamp value is null, but non null value was expected.');

        $self = new static(
            $setid,
            $url,
            $weight,
            $disabled,
            $stamp
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RtpengineDto::class);

        $setid = $dto->getSetid();
        Assertion::notNull($setid, 'getSetid value is null, but non null value was expected.');
        $url = $dto->getUrl();
        Assertion::notNull($url, 'getUrl value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $disabled = $dto->getDisabled();
        Assertion::notNull($disabled, 'getDisabled value is null, but non null value was expected.');
        $stamp = $dto->getStamp();
        Assertion::notNull($stamp, 'getStamp value is null, but non null value was expected.');

        $this
            ->setSetid($setid)
            ->setUrl($url)
            ->setWeight($weight)
            ->setDisabled($disabled)
            ->setStamp($stamp)
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($fkTransformer->transform($dto->getMediaRelaySet()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RtpengineDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'setid' => self::getSetid(),
            'url' => self::getUrl(),
            'weight' => self::getWeight(),
            'disabled' => self::getDisabled(),
            'stamp' => self::getStamp(),
            'description' => self::getDescription(),
            'mediaRelaySetId' => self::getMediaRelaySet()?->getId()
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
        $this->disabled = $disabled;

        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    protected function setStamp(string|\DateTimeInterface $stamp): static
    {

        /** @var \DateTime */
        $stamp = DateTimeHelper::createOrFix(
            $stamp,
            '2000-01-01 00:00:00'
        );

        if ($this->isInitialized() && $this->stamp == $stamp) {
            return $this;
        }

        $this->stamp = $stamp;

        return $this;
    }

    public function getStamp(): \DateTime
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
