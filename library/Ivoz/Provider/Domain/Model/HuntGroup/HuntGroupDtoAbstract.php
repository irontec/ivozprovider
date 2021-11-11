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
     * @var int|null
     */
    private $ringAllTimeout;

    /**
     * @var string|null
     */
    private $noAnswerTargetType;

    /**
     * @var string|null
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
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setStrategy(string $strategy): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setRingAllTimeout(?int $ringAllTimeout): static
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    public function getRingAllTimeout(): ?int
    {
        return $this->ringAllTimeout;
    }

    public function setNoAnswerTargetType(?string $noAnswerTargetType): static
    {
        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    public function getNoAnswerTargetType(): ?string
    {
        return $this->noAnswerTargetType;
    }

    public function setNoAnswerNumberValue(?string $noAnswerNumberValue): static
    {
        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    public function getNoAnswerNumberValue(): ?string
    {
        return $this->noAnswerNumberValue;
    }

    public function setPreventMissedCalls(int $preventMissedCalls): static
    {
        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    public function getPreventMissedCalls(): ?int
    {
        return $this->preventMissedCalls;
    }

    public function setAllowCallForwards(int $allowCallForwards): static
    {
        $this->allowCallForwards = $allowCallForwards;

        return $this;
    }

    public function getAllowCallForwards(): ?int
    {
        return $this->allowCallForwards;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNoAnswerLocution(?LocutionDto $noAnswerLocution): static
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    public function getNoAnswerLocution(): ?LocutionDto
    {
        return $this->noAnswerLocution;
    }

    public function setNoAnswerLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setNoAnswerLocution($value);
    }

    public function getNoAnswerLocutionId()
    {
        if ($dto = $this->getNoAnswerLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNoAnswerExtension(?ExtensionDto $noAnswerExtension): static
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    public function getNoAnswerExtension(): ?ExtensionDto
    {
        return $this->noAnswerExtension;
    }

    public function setNoAnswerExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setNoAnswerExtension($value);
    }

    public function getNoAnswerExtensionId()
    {
        if ($dto = $this->getNoAnswerExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNoAnswerVoiceMailUser(?UserDto $noAnswerVoiceMailUser): static
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    public function getNoAnswerVoiceMailUser(): ?UserDto
    {
        return $this->noAnswerVoiceMailUser;
    }

    public function setNoAnswerVoiceMailUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setNoAnswerVoiceMailUser($value);
    }

    public function getNoAnswerVoiceMailUserId()
    {
        if ($dto = $this->getNoAnswerVoiceMailUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNoAnswerNumberCountry(?CountryDto $noAnswerNumberCountry): static
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    public function getNoAnswerNumberCountry(): ?CountryDto
    {
        return $this->noAnswerNumberCountry;
    }

    public function setNoAnswerNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNoAnswerNumberCountry($value);
    }

    public function getNoAnswerNumberCountryId()
    {
        if ($dto = $this->getNoAnswerNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHuntGroupsRelUsers(?array $huntGroupsRelUsers): static
    {
        $this->huntGroupsRelUsers = $huntGroupsRelUsers;

        return $this;
    }

    public function getHuntGroupsRelUsers(): ?array
    {
        return $this->huntGroupsRelUsers;
    }
}
