<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FaxAbstract
 * @codeCoverageIgnore
 */
abstract class FaxAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string | null
     */
    protected $email;

    /**
     * @var boolean
     */
    protected $sendByEmail = true;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $outgoingDdi;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $sendByEmail)
    {
        $this->setName($name);
        $this->setSendByEmail($sendByEmail);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Fax",
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
     * @return FaxDto
     */
    public static function createDto($id = null)
    {
        return new FaxDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FaxInterface|null $entity
     * @param int $depth
     * @return FaxDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FaxInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FaxDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FaxDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getSendByEmail()
        );

        $self
            ->setEmail($dto->getEmail())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FaxDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FaxDto::class);

        $this
            ->setName($dto->getName())
            ->setEmail($dto->getEmail())
            ->setSendByEmail($dto->getSendByEmail())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FaxDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setEmail(self::getEmail())
            ->setSendByEmail(self::getSendByEmail())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'email' => self::getEmail(),
            'sendByEmail' => self::getSendByEmail(),
            'companyId' => self::getCompany()->getId(),
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set email
     *
     * @param string $email | null
     *
     * @return static
     */
    protected function setEmail($email = null)
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 255, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sendByEmail
     *
     * @param boolean $sendByEmail
     *
     * @return static
     */
    protected function setSendByEmail($sendByEmail)
    {
        Assertion::notNull($sendByEmail, 'sendByEmail value "%s" is null, but non null value was expected.');
        Assertion::between(intval($sendByEmail), 0, 1, 'sendByEmail provided "%s" is not a valid boolean value.');
        $sendByEmail = (bool) $sendByEmail;

        $this->sendByEmail = $sendByEmail;

        return $this;
    }

    /**
     * Get sendByEmail
     *
     * @return boolean
     */
    public function getSendByEmail()
    {
        return $this->sendByEmail;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi | null
     *
     * @return static
     */
    protected function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    // @codeCoverageIgnoreEnd
}
