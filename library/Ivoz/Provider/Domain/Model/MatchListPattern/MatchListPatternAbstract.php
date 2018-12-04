<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * MatchListPatternAbstract
 * @codeCoverageIgnore
 */
abstract class MatchListPatternAbstract
{
    /**
     * @var string | null
     */
    protected $description;

    /**
     * comment: enum:number|regexp
     * @var string
     */
    protected $type;

    /**
     * @var string | null
     */
    protected $regexp;

    /**
     * @var string | null
     */
    protected $numbervalue;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $numberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($type)
    {
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "MatchListPattern",
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
     * @return MatchListPatternDto
     */
    public static function createDto($id = null)
    {
        return new MatchListPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return MatchListPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MatchListPatternInterface::class);

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
         * @var $dto MatchListPatternDto
         */
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);

        $self = new static(
            $dto->getType()
        );

        $self
            ->setDescription($dto->getDescription())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
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
         * @var $dto MatchListPatternDto
         */
        Assertion::isInstanceOf($dto, MatchListPatternDto::class);

        $this
            ->setDescription($dto->getDescription())
            ->setType($dto->getType())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return MatchListPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setDescription(self::getDescription())
            ->setType(self::getType())
            ->setRegexp(self::getRegexp())
            ->setNumbervalue(self::getNumbervalue())
            ->setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getMatchList(), $depth))
            ->setNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'description' => self::getDescription(),
            'type' => self::getType(),
            'regExp' => self::getRegexp(),
            'numberValue' => self::getNumbervalue(),
            'matchListId' => self::getMatchList() ? self::getMatchList()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
            Assertion::maxLength($description, 55, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
          0 => 'number',
          1 => 'regexp',
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
     * Set regexp
     *
     * @param string $regexp
     *
     * @return self
     */
    protected function setRegexp($regexp = null)
    {
        if (!is_null($regexp)) {
            Assertion::maxLength($regexp, 255, 'regexp value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->regexp = $regexp;

        return $this;
    }

    /**
     * Get regexp
     *
     * @return string | null
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * Set numbervalue
     *
     * @param string $numbervalue
     *
     * @return self
     */
    protected function setNumbervalue($numbervalue = null)
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25, 'numbervalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numbervalue = $numbervalue;

        return $this;
    }

    /**
     * Get numbervalue
     *
     * @return string | null
     */
    public function getNumbervalue()
    {
        return $this->numbervalue;
    }

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return self
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList = null)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry
     *
     * @return self
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }

    // @codeCoverageIgnoreEnd
}
