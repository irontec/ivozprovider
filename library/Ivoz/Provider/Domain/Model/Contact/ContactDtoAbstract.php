<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ContactDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $workPhone;

    /**
     * @var string
     */
    private $workPhoneE164;

    /**
     * @var string
     */
    private $mobilePhone;

    /**
     * @var string
     */
    private $mobilePhoneE164;

    /**
     * @var string
     */
    private $otherPhone;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $workPhoneCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $mobilePhoneCountry;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'lastname' => 'lastname',
            'email' => 'email',
            'workPhone' => 'workPhone',
            'workPhoneE164' => 'workPhoneE164',
            'mobilePhone' => 'mobilePhone',
            'mobilePhoneE164' => 'mobilePhoneE164',
            'otherPhone' => 'otherPhone',
            'id' => 'id',
            'userId' => 'user',
            'companyId' => 'company',
            'workPhoneCountryId' => 'workPhoneCountry',
            'mobilePhoneCountryId' => 'mobilePhoneCountry'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'workPhone' => $this->getWorkPhone(),
            'workPhoneE164' => $this->getWorkPhoneE164(),
            'mobilePhone' => $this->getMobilePhone(),
            'mobilePhoneE164' => $this->getMobilePhoneE164(),
            'otherPhone' => $this->getOtherPhone(),
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'company' => $this->getCompany(),
            'workPhoneCountry' => $this->getWorkPhoneCountry(),
            'mobilePhoneCountry' => $this->getMobilePhoneCountry()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $lastname
     *
     * @return static
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $workPhone
     *
     * @return static
     */
    public function setWorkPhone($workPhone = null)
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhoneE164
     *
     * @return static
     */
    public function setWorkPhoneE164($workPhoneE164 = null)
    {
        $this->workPhoneE164 = $workPhoneE164;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWorkPhoneE164()
    {
        return $this->workPhoneE164;
    }

    /**
     * @param string $mobilePhone
     *
     * @return static
     */
    public function setMobilePhone($mobilePhone = null)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param string $mobilePhoneE164
     *
     * @return static
     */
    public function setMobilePhoneE164($mobilePhoneE164 = null)
    {
        $this->mobilePhoneE164 = $mobilePhoneE164;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMobilePhoneE164()
    {
        return $this->mobilePhoneE164;
    }

    /**
     * @param string $otherPhone
     *
     * @return static
     */
    public function setOtherPhone($otherPhone = null)
    {
        $this->otherPhone = $otherPhone;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOtherPhone()
    {
        return $this->otherPhone;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserDto $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $workPhoneCountry
     *
     * @return static
     */
    public function setWorkPhoneCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $workPhoneCountry = null)
    {
        $this->workPhoneCountry = $workPhoneCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getWorkPhoneCountry()
    {
        return $this->workPhoneCountry;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setWorkPhoneCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setWorkPhoneCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getWorkPhoneCountryId()
    {
        if ($dto = $this->getWorkPhoneCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $mobilePhoneCountry
     *
     * @return static
     */
    public function setMobilePhoneCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $mobilePhoneCountry = null)
    {
        $this->mobilePhoneCountry = $mobilePhoneCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getMobilePhoneCountry()
    {
        return $this->mobilePhoneCountry;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setMobilePhoneCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setMobilePhoneCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getMobilePhoneCountryId()
    {
        if ($dto = $this->getMobilePhoneCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
