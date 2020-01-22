<?php

namespace Ivoz\Provider\Domain\Model\Currency;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CurrencyAbstract
 * @codeCoverageIgnore
 */
abstract class CurrencyAbstract
{
    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @var Name
     */
    protected $name;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($iden, $symbol, Name $name)
    {
        $this->setIden($iden);
        $this->setSymbol($symbol);
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Currency",
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
     * @return CurrencyDto
     */
    public static function createDto($id = null)
    {
        return new CurrencyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CurrencyInterface|null $entity
     * @param int $depth
     * @return CurrencyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CurrencyInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CurrencyDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CurrencyDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CurrencyDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $self = new static(
            $dto->getIden(),
            $dto->getSymbol(),
            $name
        );

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CurrencyDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CurrencyDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $this
            ->setIden($dto->getIden())
            ->setSymbol($dto->getSymbol())
            ->setName($name);



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CurrencyDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setSymbol(self::getSymbol())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'symbol' => self::getSymbol(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return static
     */
    protected function setIden($iden)
    {
        Assertion::notNull($iden, 'iden value "%s" is null, but non null value was expected.');
        Assertion::maxLength($iden, 10, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set symbol
     *
     * @param string $symbol
     *
     * @return static
     */
    protected function setSymbol($symbol)
    {
        Assertion::notNull($symbol, 'symbol value "%s" is null, but non null value was expected.');
        Assertion::maxLength($symbol, 5, 'symbol value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\Name $name
     *
     * @return static
     */
    public function setName(Name $name)
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\Name
     */
    public function getName()
    {
        return $this->name;
    }
    // @codeCoverageIgnoreEnd
}
