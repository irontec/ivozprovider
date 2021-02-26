<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\Fax\FaxDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;

/**
* DdiDtoAbstract
* @codeCoverageIgnore
*/
abstract class DdiDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $ddi = '';

    /**
     * @var string|null
     */
    private $ddie164;

    /**
     * @var string
     */
    private $recordCalls = 'none';

    /**
     * @var string|null
     */
    private $displayName;

    /**
     * @var string|null
     */
    private $routeType;

    /**
     * @var bool
     */
    private $billInboundCalls = false;

    /**
     * @var string|null
     */
    private $friendValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var ConferenceRoomDto | null
     */
    private $conferenceRoom;

    /**
     * @var LanguageDto | null
     */
    private $language;

    /**
     * @var QueueDto | null
     */
    private $queue;

    /**
     * @var ExternalCallFilterDto | null
     */
    private $externalCallFilter;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var IvrDto | null
     */
    private $ivr;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup;

    /**
     * @var FaxDto | null
     */
    private $fax;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider;

    /**
     * @var CountryDto | null
     */
    private $country;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount;

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
            'ddi' => 'ddi',
            'ddie164' => 'ddie164',
            'recordCalls' => 'recordCalls',
            'displayName' => 'displayName',
            'routeType' => 'routeType',
            'billInboundCalls' => 'billInboundCalls',
            'friendValue' => 'friendValue',
            'id' => 'id',
            'companyId' => 'company',
            'brandId' => 'brand',
            'conferenceRoomId' => 'conferenceRoom',
            'languageId' => 'language',
            'queueId' => 'queue',
            'externalCallFilterId' => 'externalCallFilter',
            'userId' => 'user',
            'ivrId' => 'ivr',
            'huntGroupId' => 'huntGroup',
            'faxId' => 'fax',
            'ddiProviderId' => 'ddiProvider',
            'countryId' => 'country',
            'residentialDeviceId' => 'residentialDevice',
            'conditionalRouteId' => 'conditionalRoute',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'ddi' => $this->getDdi(),
            'ddie164' => $this->getDdie164(),
            'recordCalls' => $this->getRecordCalls(),
            'displayName' => $this->getDisplayName(),
            'routeType' => $this->getRouteType(),
            'billInboundCalls' => $this->getBillInboundCalls(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'brand' => $this->getBrand(),
            'conferenceRoom' => $this->getConferenceRoom(),
            'language' => $this->getLanguage(),
            'queue' => $this->getQueue(),
            'externalCallFilter' => $this->getExternalCallFilter(),
            'user' => $this->getUser(),
            'ivr' => $this->getIvr(),
            'huntGroup' => $this->getHuntGroup(),
            'fax' => $this->getFax(),
            'ddiProvider' => $this->getDdiProvider(),
            'country' => $this->getCountry(),
            'residentialDevice' => $this->getResidentialDevice(),
            'conditionalRoute' => $this->getConditionalRoute(),
            'retailAccount' => $this->getRetailAccount()
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

    public function setDdi(?string $ddi): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?string
    {
        return $this->ddi;
    }

    public function setDdie164(?string $ddie164): static
    {
        $this->ddie164 = $ddie164;

        return $this;
    }

    public function getDdie164(): ?string
    {
        return $this->ddie164;
    }

    public function setRecordCalls(?string $recordCalls): static
    {
        $this->recordCalls = $recordCalls;

        return $this;
    }

    public function getRecordCalls(): ?string
    {
        return $this->recordCalls;
    }

    public function setDisplayName(?string $displayName): static
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setRouteType(?string $routeType): static
    {
        $this->routeType = $routeType;

        return $this;
    }

    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    public function setBillInboundCalls(?bool $billInboundCalls): static
    {
        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    public function getBillInboundCalls(): ?bool
    {
        return $this->billInboundCalls;
    }

    public function setFriendValue(?string $friendValue): static
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    public function getFriendValue(): ?string
    {
        return $this->friendValue;
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

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setConferenceRoom(?ConferenceRoomDto $conferenceRoom): static
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    public function getConferenceRoom(): ?ConferenceRoomDto
    {
        return $this->conferenceRoom;
    }

    public function setConferenceRoomId($id): static
    {
        $value = !is_null($id)
            ? new ConferenceRoomDto($id)
            : null;

        return $this->setConferenceRoom($value);
    }

    public function getConferenceRoomId()
    {
        if ($dto = $this->getConferenceRoom()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLanguage(?LanguageDto $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguageId($id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    public function setQueue(?QueueDto $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function getQueue(): ?QueueDto
    {
        return $this->queue;
    }

    public function setQueueId($id): static
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }

    public function setExternalCallFilter(?ExternalCallFilterDto $externalCallFilter): static
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    public function getExternalCallFilter(): ?ExternalCallFilterDto
    {
        return $this->externalCallFilter;
    }

    public function setExternalCallFilterId($id): static
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setExternalCallFilter($value);
    }

    public function getExternalCallFilterId()
    {
        if ($dto = $this->getExternalCallFilter()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    public function setIvr(?IvrDto $ivr): static
    {
        $this->ivr = $ivr;

        return $this;
    }

    public function getIvr(): ?IvrDto
    {
        return $this->ivr;
    }

    public function setIvrId($id): static
    {
        $value = !is_null($id)
            ? new IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    public function getIvrId()
    {
        if ($dto = $this->getIvr()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHuntGroup(?HuntGroupDto $huntGroup): static
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    public function getHuntGroup(): ?HuntGroupDto
    {
        return $this->huntGroup;
    }

    public function setHuntGroupId($id): static
    {
        $value = !is_null($id)
            ? new HuntGroupDto($id)
            : null;

        return $this->setHuntGroup($value);
    }

    public function getHuntGroupId()
    {
        if ($dto = $this->getHuntGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFax(?FaxDto $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): ?FaxDto
    {
        return $this->fax;
    }

    public function setFaxId($id): static
    {
        $value = !is_null($id)
            ? new FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdiProvider(?DdiProviderDto $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    public function setDdiProviderId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCountry(?CountryDto $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    public function setCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    public function setResidentialDeviceId($id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setConditionalRoute(?ConditionalRouteDto $conditionalRoute): static
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    public function getConditionalRoute(): ?ConditionalRouteDto
    {
        return $this->conditionalRoute;
    }

    public function setConditionalRouteId($id): static
    {
        $value = !is_null($id)
            ? new ConditionalRouteDto($id)
            : null;

        return $this->setConditionalRoute($value);
    }

    public function getConditionalRouteId()
    {
        if ($dto = $this->getConditionalRoute()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRetailAccount(?RetailAccountDto $retailAccount): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    public function setRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

}
