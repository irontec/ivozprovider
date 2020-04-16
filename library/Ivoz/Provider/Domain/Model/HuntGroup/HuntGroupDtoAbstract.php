<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class HuntGroupDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var integer
     */
    private $ringAllTimeout;

    /**
     * @var string
     */
    private $noAnswerTargetType;

    /**
     * @var string
     */
    private $noAnswerNumberValue;

    /**
     * @var integer
     */
    private $preventMissedCalls = 1;

    /**
     * @var integer
     */
    private $allowCallForwards = 0;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $noAnswerLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $noAnswerExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $noAnswerVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $noAnswerNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto[] | null
     */
    private $huntGroupsRelUsers = null;


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
            'description' => 'description',
            'strategy' => 'strategy',
            'ringAllTimeout' => 'ringAllTimeout',
            'noAnswerTargetType' => 'noAnswerTargetType',
            'noAnswerNumberValue' => 'noAnswerNumberValue',
            'preventMissedCalls' => 'preventMissedCalls',
            'allowCallForwards' => 'allowCallForwards',
            'id' => 'id',
            'companyId' => 'company',
            'noAnswerLocutionId' => 'noAnswerLocution',
            'noAnswerExtensionId' => 'noAnswerExtension',
            'noAnswerVoiceMailUserId' => 'noAnswerVoiceMailUser',
            'noAnswerNumberCountryId' => 'noAnswerNumberCountry'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'strategy' => $this->getStrategy(),
            'ringAllTimeout' => $this->getRingAllTimeout(),
            'noAnswerTargetType' => $this->getNoAnswerTargetType(),
            'noAnswerNumberValue' => $this->getNoAnswerNumberValue(),
            'preventMissedCalls' => $this->getPreventMissedCalls(),
            'allowCallForwards' => $this->getAllowCallForwards(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'noAnswerLocution' => $this->getNoAnswerLocution(),
            'noAnswerExtension' => $this->getNoAnswerExtension(),
            'noAnswerVoiceMailUser' => $this->getNoAnswerVoiceMailUser(),
            'noAnswerNumberCountry' => $this->getNoAnswerNumberCountry(),
            'huntGroupsRelUsers' => $this->getHuntGroupsRelUsers()
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
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $strategy
     *
     * @return static
     */
    public function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param integer $ringAllTimeout
     *
     * @return static
     */
    public function setRingAllTimeout($ringAllTimeout = null)
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getRingAllTimeout()
    {
        return $this->ringAllTimeout;
    }

    /**
     * @param string $noAnswerTargetType
     *
     * @return static
     */
    public function setNoAnswerTargetType($noAnswerTargetType = null)
    {
        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoAnswerTargetType()
    {
        return $this->noAnswerTargetType;
    }

    /**
     * @param string $noAnswerNumberValue
     *
     * @return static
     */
    public function setNoAnswerNumberValue($noAnswerNumberValue = null)
    {
        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoAnswerNumberValue()
    {
        return $this->noAnswerNumberValue;
    }

    /**
     * @param integer $preventMissedCalls
     *
     * @return static
     */
    public function setPreventMissedCalls($preventMissedCalls = null)
    {
        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getPreventMissedCalls()
    {
        return $this->preventMissedCalls;
    }

    /**
     * @param integer $allowCallForwards
     *
     * @return static
     */
    public function setAllowCallForwards($allowCallForwards = null)
    {
        $this->allowCallForwards = $allowCallForwards;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getAllowCallForwards()
    {
        return $this->allowCallForwards;
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
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $noAnswerLocution
     *
     * @return static
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $noAnswerLocution = null)
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNoAnswerLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setNoAnswerLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoAnswerLocutionId()
    {
        if ($dto = $this->getNoAnswerLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noAnswerExtension
     *
     * @return static
     */
    public function setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noAnswerExtension = null)
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    public function getNoAnswerExtension()
    {
        return $this->noAnswerExtension;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNoAnswerExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setNoAnswerExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoAnswerExtensionId()
    {
        if ($dto = $this->getNoAnswerExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $noAnswerVoiceMailUser
     *
     * @return static
     */
    public function setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $noAnswerVoiceMailUser = null)
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    public function getNoAnswerVoiceMailUser()
    {
        return $this->noAnswerVoiceMailUser;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNoAnswerVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setNoAnswerVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoAnswerVoiceMailUserId()
    {
        if ($dto = $this->getNoAnswerVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $noAnswerNumberCountry
     *
     * @return static
     */
    public function setNoAnswerNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $noAnswerNumberCountry = null)
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getNoAnswerNumberCountry()
    {
        return $this->noAnswerNumberCountry;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNoAnswerNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setNoAnswerNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNoAnswerNumberCountryId()
    {
        if ($dto = $this->getNoAnswerNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $huntGroupsRelUsers
     *
     * @return static
     */
    public function setHuntGroupsRelUsers($huntGroupsRelUsers = null)
    {
        $this->huntGroupsRelUsers = $huntGroupsRelUsers;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getHuntGroupsRelUsers()
    {
        return $this->huntGroupsRelUsers;
    }
}
