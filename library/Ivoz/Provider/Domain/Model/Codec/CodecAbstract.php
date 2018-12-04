<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CodecAbstract
 * @codeCoverageIgnore
 */
abstract class CodecAbstract
{
    /**
     * comment: enum:audio|video
     * @var string
     */
    protected $type = 'audio';

    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string
     */
    protected $name;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($type, $iden, $name)
    {
        $this->setType($type);
        $this->setIden($iden);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Codec",
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
     * @return CodecDto
     */
    public static function createDto($id = null)
    {
        return new CodecDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CodecDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CodecInterface::class);

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
         * @var $dto CodecDto
         */
        Assertion::isInstanceOf($dto, CodecDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getIden(),
            $dto->getName()
        );

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
         * @var $dto CodecDto
         */
        Assertion::isInstanceOf($dto, CodecDto::class);

        $this
            ->setType($dto->getType())
            ->setIden($dto->getIden())
            ->setName($dto->getName());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CodecDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setType(self::getType())
            ->setIden(self::getIden())
            ->setName(self::getName());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'type' => self::getType(),
            'iden' => self::getIden(),
            'name' => self::getName()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, array (
          0 => 'audio',
          1 => 'video',
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

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return self
     */
    protected function setIden($iden)
    {
        Assertion::notNull($iden, 'iden value "%s" is null, but non null value was expected.');
        Assertion::maxLength($iden, 25, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden()
    {
        return $this->iden;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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

    // @codeCoverageIgnoreEnd
}
