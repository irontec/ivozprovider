<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var \DateTimeInterface
     */
    protected $stamp = '2000-01-01 00:00:00';

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var MediaRelaySetInterface
     */
    protected $mediaRelaySet;

    /**
     * Constructor
     */
    protected function __construct(
        $setid,
        $url,
        $weight,
        $disabled,
        $stamp
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
     * @param null $id
     * @return RtpengineDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return RtpengineDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set setid
     *
     * @param int $setid
     *
     * @return static
     */
    protected function setSetid(int $setid): RtpengineInterface
    {
        $this->setid = $setid;

        return $this;
    }

    /**
     * Get setid
     *
     * @return int
     */
    public function getSetid(): int
    {
        return $this->setid;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return static
     */
    protected function setUrl(string $url): RtpengineInterface
    {
        Assertion::maxLength($url, 64, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set weight
     *
     * @param int $weight
     *
     * @return static
     */
    protected function setWeight(int $weight): RtpengineInterface
    {
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set disabled
     *
     * @param bool $disabled
     *
     * @return static
     */
    protected function setDisabled(bool $disabled): RtpengineInterface
    {
        Assertion::between(intval($disabled), 0, 1, 'disabled provided "%s" is not a valid boolean value.');
        $disabled = (bool) $disabled;

        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return bool
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Set stamp
     *
     * @param \DateTimeInterface $stamp
     *
     * @return static
     */
    protected function setStamp($stamp): RtpengineInterface
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
     * Get stamp
     *
     * @return \DateTimeInterface
     */
    public function getStamp(): \DateTimeInterface
    {
        return clone $this->stamp;
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription(?string $description = null): RtpengineInterface
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 200, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set mediaRelaySet
     *
     * @param MediaRelaySetInterface | null
     *
     * @return static
     */
    protected function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): RtpengineInterface
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    /**
     * Get mediaRelaySet
     *
     * @return MediaRelaySetInterface | null
     */
    public function getMediaRelaySet(): ?MediaRelaySetInterface
    {
        return $this->mediaRelaySet;
    }

}
