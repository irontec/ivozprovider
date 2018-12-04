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
     * @param EntityInterface|null $entity
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
         * @var $dto CurrencyDto
         */
        Assertion::isInstanceOf($dto, CurrencyDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $self = new static(
            $dto->getIden(),
            $dto->getSymbol(),
            $name
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
         * @var $dto CurrencyDto
         */
        Assertion::isInstanceOf($dto, CurrencyDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $this
            ->setIden($dto->getIden())
            ->setSymbol($dto->getSymbol())
            ->setName($name);



        $this->sanitizeValues();
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
            ->setNameEs(self::getName()->getEs());
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
            'nameEs' => self::getName()->getEs()
        ];
    }
    // @codeCoverageIgnoreStart

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
     * @return self
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
     * @return self
     */
    public function setName(Name $name)
    {
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
