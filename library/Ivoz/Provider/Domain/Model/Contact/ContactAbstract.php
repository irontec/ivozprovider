<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ContactAbstract
 * @codeCoverageIgnore
 */
abstract class ContactAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string | null
     */
    protected $lastname;

    /**
     * @var string | null
     */
    protected $email;

    /**
     * @var string | null
     */
    protected $workPhone;

    /**
     * @var string | null
     */
    protected $workPhoneE164;

    /**
     * @var string | null
     */
    protected $mobilePhone;

    /**
     * @var string | null
     */
    protected $mobilePhoneE164;

    /**
     * @var string | null
     */
    protected $otherPhone;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $workPhoneCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $mobilePhoneCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name)
    {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Contact",
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
     * @return ContactDto
     */
    public static function createDto($id = null)
    {
        return new ContactDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ContactInterface|null $entity
     * @param int $depth
     * @return ContactDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ContactInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ContactDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ContactDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ContactDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setLastname($dto->getLastname())
            ->setEmail($dto->getEmail())
            ->setWorkPhone($dto->getWorkPhone())
            ->setWorkPhoneE164($dto->getWorkPhoneE164())
            ->setMobilePhone($dto->getMobilePhone())
            ->setMobilePhoneE164($dto->getMobilePhoneE164())
            ->setOtherPhone($dto->getOtherPhone())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWorkPhoneCountry($fkTransformer->transform($dto->getWorkPhoneCountry()))
            ->setMobilePhoneCountry($fkTransformer->transform($dto->getMobilePhoneCountry()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ContactDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ContactDto::class);

        $this
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setEmail($dto->getEmail())
            ->setWorkPhone($dto->getWorkPhone())
            ->setWorkPhoneE164($dto->getWorkPhoneE164())
            ->setMobilePhone($dto->getMobilePhone())
            ->setMobilePhoneE164($dto->getMobilePhoneE164())
            ->setOtherPhone($dto->getOtherPhone())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setWorkPhoneCountry($fkTransformer->transform($dto->getWorkPhoneCountry()))
            ->setMobilePhoneCountry($fkTransformer->transform($dto->getMobilePhoneCountry()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ContactDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setLastname(self::getLastname())
            ->setEmail(self::getEmail())
            ->setWorkPhone(self::getWorkPhone())
            ->setWorkPhoneE164(self::getWorkPhoneE164())
            ->setMobilePhone(self::getMobilePhone())
            ->setMobilePhoneE164(self::getMobilePhoneE164())
            ->setOtherPhone(self::getOtherPhone())
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setWorkPhoneCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getWorkPhoneCountry(), $depth))
            ->setMobilePhoneCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getMobilePhoneCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'lastname' => self::getLastname(),
            'email' => self::getEmail(),
            'workPhone' => self::getWorkPhone(),
            'workPhoneE164' => self::getWorkPhoneE164(),
            'mobilePhone' => self::getMobilePhone(),
            'mobilePhoneE164' => self::getMobilePhoneE164(),
            'otherPhone' => self::getOtherPhone(),
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'companyId' => self::getCompany()->getId(),
            'workPhoneCountryId' => self::getWorkPhoneCountry() ? self::getWorkPhoneCountry()->getId() : null,
            'mobilePhoneCountryId' => self::getMobilePhoneCountry() ? self::getMobilePhoneCountry()->getId() : null
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
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname | null
     *
     * @return static
     */
    protected function setLastname($lastname = null)
    {
        if (!is_null($lastname)) {
            Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string | null
     */
    public function getLastname()
    {
        return $this->lastname;
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
            Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set workPhone
     *
     * @param string $workPhone | null
     *
     * @return static
     */
    protected function setWorkPhone($workPhone = null)
    {
        if (!is_null($workPhone)) {
            Assertion::maxLength($workPhone, 20, 'workPhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->workPhone = $workPhone;

        return $this;
    }

    /**
     * Get workPhone
     *
     * @return string | null
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * Set workPhoneE164
     *
     * @param string $workPhoneE164 | null
     *
     * @return static
     */
    protected function setWorkPhoneE164($workPhoneE164 = null)
    {
        if (!is_null($workPhoneE164)) {
            Assertion::maxLength($workPhoneE164, 25, 'workPhoneE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->workPhoneE164 = $workPhoneE164;

        return $this;
    }

    /**
     * Get workPhoneE164
     *
     * @return string | null
     */
    public function getWorkPhoneE164()
    {
        return $this->workPhoneE164;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone | null
     *
     * @return static
     */
    protected function setMobilePhone($mobilePhone = null)
    {
        if (!is_null($mobilePhone)) {
            Assertion::maxLength($mobilePhone, 20, 'mobilePhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string | null
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set mobilePhoneE164
     *
     * @param string $mobilePhoneE164 | null
     *
     * @return static
     */
    protected function setMobilePhoneE164($mobilePhoneE164 = null)
    {
        if (!is_null($mobilePhoneE164)) {
            Assertion::maxLength($mobilePhoneE164, 25, 'mobilePhoneE164 value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mobilePhoneE164 = $mobilePhoneE164;

        return $this;
    }

    /**
     * Get mobilePhoneE164
     *
     * @return string | null
     */
    public function getMobilePhoneE164()
    {
        return $this->mobilePhoneE164;
    }

    /**
     * Set otherPhone
     *
     * @param string $otherPhone | null
     *
     * @return static
     */
    protected function setOtherPhone($otherPhone = null)
    {
        if (!is_null($otherPhone)) {
            Assertion::maxLength($otherPhone, 25, 'otherPhone value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->otherPhone = $otherPhone;

        return $this;
    }

    /**
     * Get otherPhone
     *
     * @return string | null
     */
    public function getOtherPhone()
    {
        return $this->otherPhone;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
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
     * Set workPhoneCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $workPhoneCountry | null
     *
     * @return static
     */
    protected function setWorkPhoneCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $workPhoneCountry = null)
    {
        $this->workPhoneCountry = $workPhoneCountry;

        return $this;
    }

    /**
     * Get workPhoneCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getWorkPhoneCountry()
    {
        return $this->workPhoneCountry;
    }

    /**
     * Set mobilePhoneCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $mobilePhoneCountry | null
     *
     * @return static
     */
    protected function setMobilePhoneCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $mobilePhoneCountry = null)
    {
        $this->mobilePhoneCountry = $mobilePhoneCountry;

        return $this;
    }

    /**
     * Get mobilePhoneCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getMobilePhoneCountry()
    {
        return $this->mobilePhoneCountry;
    }

    // @codeCoverageIgnoreEnd
}
