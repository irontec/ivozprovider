<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * InvoiceSchedulerAbstract
 * @codeCoverageIgnore
 */
abstract class InvoiceSchedulerAbstract
{
    /**
     * @var string
     */
    protected $iden;

    /**
     * comment: enum:week|month|year
     * @var string
     */
    protected $unit = 'month';

    /**
     * @var integer
     */
    protected $frequency;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var boolean
     */
    protected $inProgress = '0';

    /**
     * @var \DateTime
     */
    protected $lastExecution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface
     */
    protected $numberSequence;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $iden,
        $unit,
        $frequency,
        $email,
        $inProgress
    ) {
        $this->setIden($iden);
        $this->setUnit($unit);
        $this->setFrequency($frequency);
        $this->setEmail($email);
        $this->setInProgress($inProgress);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "InvoiceScheduler",
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
     * @return InvoiceSchedulerDto
     */
    public static function createDto($id = null)
    {
        return new InvoiceSchedulerDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return InvoiceSchedulerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, InvoiceSchedulerInterface::class);

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
         * @var $dto InvoiceSchedulerDto
         */
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);

        $self = new static(
            $dto->getIden(),
            $dto->getUnit(),
            $dto->getFrequency(),
            $dto->getEmail(),
            $dto->getInProgress());

        $self
            ->setLastExecution($dto->getLastExecution())
            ->setBrand($dto->getBrand())
            ->setNumberSequence($dto->getNumberSequence())
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
         * @var $dto InvoiceSchedulerDto
         */
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);

        $this
            ->setIden($dto->getIden())
            ->setUnit($dto->getUnit())
            ->setFrequency($dto->getFrequency())
            ->setEmail($dto->getEmail())
            ->setInProgress($dto->getInProgress())
            ->setLastExecution($dto->getLastExecution())
            ->setBrand($dto->getBrand())
            ->setNumberSequence($dto->getNumberSequence());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return InvoiceSchedulerDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setUnit(self::getUnit())
            ->setFrequency(self::getFrequency())
            ->setEmail(self::getEmail())
            ->setInProgress(self::getInProgress())
            ->setLastExecution(self::getLastExecution())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence::entityToDto(self::getNumberSequence(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'unit' => self::getUnit(),
            'frequency' => self::getFrequency(),
            'email' => self::getEmail(),
            'inProgress' => self::getInProgress(),
            'lastExecution' => self::getLastExecution(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'numberSequenceId' => self::getNumberSequence() ? self::getNumberSequence()->getId() : null
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
    public function setIden($iden)
    {
        Assertion::notNull($iden, 'iden value "%s" is null, but non null value was expected.');
        Assertion::maxLength($iden, 40, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set unit
     *
     * @param string $unit
     *
     * @return self
     */
    public function setUnit($unit)
    {
        Assertion::notNull($unit, 'unit value "%s" is null, but non null value was expected.');
        Assertion::maxLength($unit, 30, 'unit value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($unit, array (
          0 => 'week',
          1 => 'month',
          2 => 'year',
        ), 'unitvalue "%s" is not an element of the valid values: %s');

        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set frequency
     *
     * @param integer $frequency
     *
     * @return self
     */
    public function setFrequency($frequency)
    {
        Assertion::notNull($frequency, 'frequency value "%s" is null, but non null value was expected.');
        Assertion::integerish($frequency, 'frequency value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        Assertion::notNull($email, 'email value "%s" is null, but non null value was expected.');
        Assertion::maxLength($email, 140, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set inProgress
     *
     * @param boolean $inProgress
     *
     * @return self
     */
    public function setInProgress($inProgress)
    {
        Assertion::notNull($inProgress, 'inProgress value "%s" is null, but non null value was expected.');
        Assertion::between(intval($inProgress), 0, 1, 'inProgress provided "%s" is not a valid boolean value.');

        $this->inProgress = $inProgress;

        return $this;
    }

    /**
     * Get inProgress
     *
     * @return boolean
     */
    public function getInProgress()
    {
        return $this->inProgress;
    }

    /**
     * Set lastExecution
     *
     * @param \DateTime $lastExecution
     *
     * @return self
     */
    public function setLastExecution($lastExecution = null)
    {
        if (!is_null($lastExecution)) {
        $lastExecution = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $lastExecution,
            null
        );
        }

        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * Get lastExecution
     *
     * @return \DateTime
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set numberSequence
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence
     *
     * @return self
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence = null)
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * Get numberSequence
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface
     */
    public function getNumberSequence()
    {
        return $this->numberSequence;
    }



    // @codeCoverageIgnoreEnd
}

