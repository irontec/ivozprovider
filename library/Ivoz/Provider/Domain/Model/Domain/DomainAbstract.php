<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DomainAbstract
 * @codeCoverageIgnore
 */
abstract class DomainAbstract
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $pointsTo = 'proxyusers';

    /**
     * @var string | null
     */
    protected $description;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($domain, $pointsTo)
    {
        $this->setDomain($domain);
        $this->setPointsTo($pointsTo);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Domain",
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
     * @return DomainDto
     */
    public static function createDto($id = null)
    {
        return new DomainDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return DomainDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DomainInterface::class);

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
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDto
         */
        Assertion::isInstanceOf($dto, DomainDto::class);

        $self = new static(
            $dto->getDomain(),
            $dto->getPointsTo()
        );

        $self
            ->setDescription($dto->getDescription())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDto
         */
        Assertion::isInstanceOf($dto, DomainDto::class);

        $this
            ->setDomain($dto->getDomain())
            ->setPointsTo($dto->getPointsTo())
            ->setDescription($dto->getDescription());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DomainDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDomain(self::getDomain())
            ->setPointsTo(self::getPointsTo())
            ->setDescription(self::getDescription());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'domain' => self::getDomain(),
            'pointsTo' => self::getPointsTo(),
            'description' => self::getDescription()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    protected function setDomain($domain)
    {
        Assertion::notNull($domain, 'domain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set pointsTo
     *
     * @param string $pointsTo
     *
     * @return self
     */
    protected function setPointsTo($pointsTo)
    {
        Assertion::notNull($pointsTo, 'pointsTo value "%s" is null, but non null value was expected.');

        $this->pointsTo = $pointsTo;

        return $this;
    }

    /**
     * Get pointsTo
     *
     * @return string
     */
    public function getPointsTo()
    {
        return $this->pointsTo;
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
            Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

    // @codeCoverageIgnoreEnd
}
