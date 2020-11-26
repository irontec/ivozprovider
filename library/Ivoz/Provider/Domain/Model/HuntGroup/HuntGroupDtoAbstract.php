<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto;

/**
* HuntGroupDtoAbstract
* @codeCoverageIgnore
*/
abstract class HuntGroupDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

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
     * @var int | null
     */
    private $ringAllTimeout;

    /**
     * @var string | null
     */
    private $noAnswerTargetType;

    /**
     * @var string | null
     */
    private $noAnswerNumberValue;

    /**
     * @var int
     */
    private $preventMissedCalls = 1;

    /**
     * @var int
     */
    private $allowCallForwards = 0;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var LocutionDto | null
     */
    private $noAnswerLocution;

    /**
     * @var ExtensionDto | null
     */
    private $noAnswerExtension;

    /**
     * @var UserDto | null
     */
    private $noAnswerVoiceMailUser;

    /**
     * @var CountryDto | null
     */
    private $noAnswerNumberCountry;

    /**
     * @var HuntGroupsRelUserDto[] | null
     */
    private $huntGroupsRelUsers;

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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $strategy | null
     *
     * @return static
     */
    public function setStrategy(?string $strategy = null): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param int $ringAllTimeout | null
     *
     * @return static
     */
    public function setRingAllTimeout(?int $ringAllTimeout = null): self
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRingAllTimeout(): ?int
    {
        return $this->ringAllTimeout;
    }

    /**
     * @param string $noAnswerTargetType | null
     *
     * @return static
     */
    public function setNoAnswerTargetType(?string $noAnswerTargetType = null): self
    {
        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoAnswerTargetType(): ?string
    {
        return $this->noAnswerTargetType;
    }

    /**
     * @param string $noAnswerNumberValue | null
     *
     * @return static
     */
    public function setNoAnswerNumberValue(?string $noAnswerNumberValue = null): self
    {
        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNoAnswerNumberValue(): ?string
    {
        return $this->noAnswerNumberValue;
    }

    /**
     * @param int $preventMissedCalls | null
     *
     * @return static
     */
    public function setPreventMissedCalls(?int $preventMissedCalls = null): self
    {
        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPreventMissedCalls(): ?int
    {
        return $this->preventMissedCalls;
    }

    /**
     * @param int $allowCallForwards | null
     *
     * @return static
     */
    public function setAllowCallForwards(?int $allowCallForwards = null): self
    {
        $this->allowCallForwards = $allowCallForwards;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getAllowCallForwards(): ?int
    {
        return $this->allowCallForwards;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
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
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setNoAnswerLocution(?LocutionDto $noAnswerLocution = null): self
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getNoAnswerLocution(): ?LocutionDto
    {
        return $this->noAnswerLocution;
    }

    /**
     * @return static
     */
    public function setNoAnswerLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
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
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setNoAnswerExtension(?ExtensionDto $noAnswerExtension = null): self
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getNoAnswerExtension(): ?ExtensionDto
    {
        return $this->noAnswerExtension;
    }

    /**
     * @return static
     */
    public function setNoAnswerExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
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
     * @param UserDto | null
     *
     * @return static
     */
    public function setNoAnswerVoiceMailUser(?UserDto $noAnswerVoiceMailUser = null): self
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getNoAnswerVoiceMailUser(): ?UserDto
    {
        return $this->noAnswerVoiceMailUser;
    }

    /**
     * @return static
     */
    public function setNoAnswerVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
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
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNoAnswerNumberCountry(?CountryDto $noAnswerNumberCountry = null): self
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNoAnswerNumberCountry(): ?CountryDto
    {
        return $this->noAnswerNumberCountry;
    }

    /**
     * @return static
     */
    public function setNoAnswerNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
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
     * @param HuntGroupsRelUserDto[] | null
     *
     * @return static
     */
    public function setHuntGroupsRelUsers(?array $huntGroupsRelUsers = null): self
    {
        $this->huntGroupsRelUsers = $huntGroupsRelUsers;

        return $this;
    }

    /**
     * @return HuntGroupsRelUserDto[] | null
     */
    public function getHuntGroupsRelUsers(): ?array
    {
        return $this->huntGroupsRelUsers;
    }

}
