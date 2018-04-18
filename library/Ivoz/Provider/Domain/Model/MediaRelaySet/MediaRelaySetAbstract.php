<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * MediaRelaySetAbstract
 * @codeCoverageIgnore
 */
abstract class MediaRelaySetAbstract
{
    /**
     * @var string
     */
    protected $name = '0';

    /**
     * @var string
     */
    protected $description;

    /**
     * comment: enum:rtpengine|rtpproxy
     * @var string
     */
    protected $type = 'rtpproxy';


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $type)
    {
        $this->setName($name);
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "MediaRelaySet",
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
     * @return MediaRelaySetDto
     */
    public static function createDto($id = null)
    {
        return new MediaRelaySetDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return MediaRelaySetDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MediaRelaySetInterface::class);

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
         * @var $dto MediaRelaySetDto
         */
        Assertion::isInstanceOf($dto, MediaRelaySetDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getType());

        $self
            ->setDescription($dto->getDescription())
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
         * @var $dto MediaRelaySetDto
         */
        Assertion::isInstanceOf($dto, MediaRelaySetDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setType($dto->getType());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return MediaRelaySetDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setType(self::getType());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'type' => self::getType()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 32, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 64, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, array (
          0 => 'rtpengine',
          1 => 'rtpproxy',
        ), 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }



    // @codeCoverageIgnoreEnd
}

