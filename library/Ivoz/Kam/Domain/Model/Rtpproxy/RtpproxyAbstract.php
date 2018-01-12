<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RtpproxyAbstract
 * @codeCoverageIgnore
 */
abstract class RtpproxyAbstract
{
    /**
     * @var string
     */
    protected $setid = '0';

    /**
     * @var string
     */
    protected $url;

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * @var integer
     */
    protected $weight = '1';

    /**
     * @var string
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
    protected function __construct($setid, $url, $flags, $weight)
    {
        $this->setSetid($setid);
        $this->setUrl($url);
        $this->setFlags($flags);
        $this->setWeight($weight);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "Rtpproxy",
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
     * @return RtpproxyDto
     */
    public static function createDto($id = null)
    {
        return new RtpproxyDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return RtpproxyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RtpproxyInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RtpproxyDto
         */
        Assertion::isInstanceOf($dto, RtpproxyDto::class);

        $self = new static(
            $dto->getSetid(),
            $dto->getUrl(),
            $dto->getFlags(),
            $dto->getWeight());

        $self
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($dto->getMediaRelaySet())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RtpproxyDto
         */
        Assertion::isInstanceOf($dto, RtpproxyDto::class);

        $this
            ->setSetid($dto->getSetid())
            ->setUrl($dto->getUrl())
            ->setFlags($dto->getFlags())
            ->setWeight($dto->getWeight())
            ->setDescription($dto->getDescription())
            ->setMediaRelaySet($dto->getMediaRelaySet());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return RtpproxyDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setSetid($this->getSetid())
            ->setUrl($this->getUrl())
            ->setFlags($this->getFlags())
            ->setWeight($this->getWeight())
            ->setDescription($this->getDescription())
            ->setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet::entityToDto($this->getMediaRelaySet(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'setid' => self::getSetid(),
            'url' => self::getUrl(),
            'flags' => self::getFlags(),
            'weight' => self::getWeight(),
            'description' => self::getDescription(),
            'mediaRelaySetId' => self::getMediaRelaySet() ? self::getMediaRelaySet()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set setid
     *
     * @param string $setid
     *
     * @return self
     */
    public function setSetid($setid)
    {
        Assertion::notNull($setid, 'setid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($setid, 32, 'setid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->setid = $setid;

        return $this;
    }

    /**
     * Get setid
     *
     * @return string
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
    public function setUrl($url)
    {
        Assertion::notNull($url, 'url value "%s" is null, but non null value was expected.');
        Assertion::maxLength($url, 128, 'url value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags)
    {
        Assertion::notNull($flags, 'flags value "%s" is null, but non null value was expected.');
        Assertion::integerish($flags, 'flags value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($flags, 0, 'flags provided "%s" is not greater or equal than "%s".');

        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight)
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
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
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
     * @return string
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

