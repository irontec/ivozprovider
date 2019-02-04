<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RtpengineAbstract
 * @codeCoverageIgnore
 */
abstract class RtpengineAbstract
{
    /**
     * @var integer
     */
    protected $setid = 0;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var integer
     */
    protected $weight = '1';

    /**
     * @var boolean
     */
    protected $disabled = '0';

    /**
     * @var \DateTime
     */
    protected $stamp;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    protected $mediaRelaySet;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($setid, $url, $weight, $disabled, $stamp)
    {
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
     * @param EntityInterface|null $entity
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
         * @var $dto RtpengineDto
         */
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
            ->setMediaRelaySet($fkTransformer->transform($dto->getMediaRelaySet()))
        ;

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
         * @var $dto RtpengineDto
         */
        Assertion::isInstanceOf($dto, RtpengineDto::class);

        $this
            ->setSetid($dto->getSetid())
            ->setUrl($dto->getUrl())
            ->setWeight($dto->getWeight())
            ->setDisabled($dto->getDisabled())
            ->setStamp($dto->getStamp())
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($fkTransformer->transform($dto->getMediaRelaySet()));



        $this->sanitizeValues();
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
            ->setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet::entityToDto(self::getMediaRelaySet(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set setid
     *
     * @param integer $setid
     *
     * @return self
     */
    protected function setSetid($setid)
    {
        Assertion::notNull($setid, 'setid value "%s" is null, but non null value was expected.');
        Assertion::integerish($setid, 'setid value "%s" is not an integer or a number castable to integer.');

        $this->setid = $setid;

        return $this;
    }

    /**
     * Get setid
     *
     * @return integer
     */
    public function getSetid()
    {
        return $this->setid;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    protected function setUrl($url)
    {
        Assertion::notNull($url, 'url value "%s" is null, but non null value was expected.');
        Assertion::maxLength($url, 64, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    protected function setWeight($weight)
    {
        Assertion::notNull($weight, 'weight value "%s" is null, but non null value was expected.');
        Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($weight, 0, 'weight provided "%s" is not greater or equal than "%s".');

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return self
     */
    protected function setDisabled($disabled)
    {
        Assertion::notNull($disabled, 'disabled value "%s" is null, but non null value was expected.');
        Assertion::between(intval($disabled), 0, 1, 'disabled provided "%s" is not a valid boolean value.');

        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set stamp
     *
     * @param \DateTime $stamp
     *
     * @return self
     */
    protected function setStamp($stamp)
    {
        Assertion::notNull($stamp, 'stamp value "%s" is null, but non null value was expected.');
        $stamp = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $stamp,
            '2000-01-01 00:00:00'
        );

        $this->stamp = $stamp;

        return $this;
    }

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp()
    {
        return clone $this->stamp;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    protected function setDescription($description = null)
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mediaRelaySet
     *
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySet
     *
     * @return self
     */
    public function setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySet = null)
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    /**
     * Get mediaRelaySet
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySet()
    {
        return $this->mediaRelaySet;
    }

    // @codeCoverageIgnoreEnd
}
