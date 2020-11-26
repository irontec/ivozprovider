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
    private $ddi;

    /**
     * @var string | null
     */
    private $ddie164;

    /**
     * @var string
     */
    private $recordCalls = 'none';

    /**
     * @var string | null
     */
    private $displayName;

    /**
     * @var string | null
     */
    private $routeType;

    /**
     * @var bool
     */
    private $billInboundCalls = false;

    /**
     * @var string | null
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

    /**
     * @param string $ddi | null
     *
     * @return static
     */
    public function setDdi(?string $ddi = null): self
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDdi(): ?string
    {
        return $this->ddi;
    }

    /**
     * @param string $ddie164 | null
     *
     * @return static
     */
    public function setDdie164(?string $ddie164 = null): self
    {
        $this->ddie164 = $ddie164;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDdie164(): ?string
    {
        return $this->ddie164;
    }

    /**
     * @param string $recordCalls | null
     *
     * @return static
     */
    public function setRecordCalls(?string $recordCalls = null): self
    {
        $this->recordCalls = $recordCalls;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecordCalls(): ?string
    {
        return $this->recordCalls;
    }

    /**
     * @param string $displayName | null
     *
     * @return static
     */
    public function setDisplayName(?string $displayName = null): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param string $routeType | null
     *
     * @return static
     */
    public function setRouteType(?string $routeType = null): self
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    /**
     * @param bool $billInboundCalls | null
     *
     * @return static
     */
    public function setBillInboundCalls(?bool $billInboundCalls = null): self
    {
        $this->billInboundCalls = $billInboundCalls;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getBillInboundCalls(): ?bool
    {
        return $this->billInboundCalls;
    }

    /**
     * @param string $friendValue | null
     *
     * @return static
     */
    public function setFriendValue(?string $friendValue = null): self
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFriendValue(): ?string
    {
        return $this->friendValue;
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
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ConferenceRoomDto | null
     *
     * @return static
     */
    public function setConferenceRoom(?ConferenceRoomDto $conferenceRoom = null): self
    {
        $this->conferenceRoom = $conferenceRoom;

        return $this;
    }

    /**
     * @return ConferenceRoomDto | null
     */
    public function getConferenceRoom(): ?ConferenceRoomDto
    {
        return $this->conferenceRoom;
    }

    /**
     * @return static
     */
    public function setConferenceRoomId($id): self
    {
        $value = !is_null($id)
            ? new ConferenceRoomDto($id)
            : null;

        return $this->setConferenceRoom($value);
    }

    /**
     * @return mixed | null
     */
    public function getConferenceRoomId()
    {
        if ($dto = $this->getConferenceRoom()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LanguageDto | null
     *
     * @return static
     */
    public function setLanguage(?LanguageDto $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return LanguageDto | null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @return static
     */
    public function setLanguageId($id): self
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return mixed | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param QueueDto | null
     *
     * @return static
     */
    public function setQueue(?QueueDto $queue = null): self
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return QueueDto | null
     */
    public function getQueue(): ?QueueDto
    {
        return $this->queue;
    }

    /**
     * @return static
     */
    public function setQueueId($id): self
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    /**
     * @return mixed | null
     */
    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExternalCallFilterDto | null
     *
     * @return static
     */
    public function setExternalCallFilter(?ExternalCallFilterDto $externalCallFilter = null): self
    {
        $this->externalCallFilter = $externalCallFilter;

        return $this;
    }

    /**
     * @return ExternalCallFilterDto | null
     */
    public function getExternalCallFilter(): ?ExternalCallFilterDto
    {
        return $this->externalCallFilter;
    }

    /**
     * @return static
     */
    public function setExternalCallFilterId($id): self
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setExternalCallFilter($value);
    }

    /**
     * @return mixed | null
     */
    public function getExternalCallFilterId()
    {
        if ($dto = $this->getExternalCallFilter()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setUser(?UserDto $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    /**
     * @return static
     */
    public function setUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
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
     * @param IvrDto | null
     *
     * @return static
     */
    public function setIvr(?IvrDto $ivr = null): self
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * @return IvrDto | null
     */
    public function getIvr(): ?IvrDto
    {
        return $this->ivr;
    }

    /**
     * @return static
     */
    public function setIvrId($id): self
    {
        $value = !is_null($id)
            ? new IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    /**
     * @return mixed | null
     */
    public function getIvrId()
    {
        if ($dto = $this->getIvr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param HuntGroupDto | null
     *
     * @return static
     */
    public function setHuntGroup(?HuntGroupDto $huntGroup = null): self
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * @return HuntGroupDto | null
     */
    public function getHuntGroup(): ?HuntGroupDto
    {
        return $this->huntGroup;
    }

    /**
     * @return static
     */
    public function setHuntGroupId($id): self
    {
        $value = !is_null($id)
            ? new HuntGroupDto($id)
            : null;

        return $this->setHuntGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getHuntGroupId()
    {
        if ($dto = $this->getHuntGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param FaxDto | null
     *
     * @return static
     */
    public function setFax(?FaxDto $fax = null): self
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return FaxDto | null
     */
    public function getFax(): ?FaxDto
    {
        return $this->fax;
    }

    /**
     * @return static
     */
    public function setFaxId($id): self
    {
        $value = !is_null($id)
            ? new FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    /**
     * @return mixed | null
     */
    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiProviderDto | null
     *
     * @return static
     */
    public function setDdiProvider(?DdiProviderDto $ddiProvider = null): self
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return DdiProviderDto | null
     */
    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    /**
     * @return static
     */
    public function setDdiProviderId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setCountry(?CountryDto $country = null): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    /**
     * @return static
     */
    public function setCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ResidentialDeviceDto | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice = null): self
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return ResidentialDeviceDto | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    /**
     * @return static
     */
    public function setResidentialDeviceId($id): self
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return mixed | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ConditionalRouteDto | null
     *
     * @return static
     */
    public function setConditionalRoute(?ConditionalRouteDto $conditionalRoute = null): self
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * @return ConditionalRouteDto | null
     */
    public function getConditionalRoute(): ?ConditionalRouteDto
    {
        return $this->conditionalRoute;
    }

    /**
     * @return static
     */
    public function setConditionalRouteId($id): self
    {
        $value = !is_null($id)
            ? new ConditionalRouteDto($id)
            : null;

        return $this->setConditionalRoute($value);
    }

    /**
     * @return mixed | null
     */
    public function getConditionalRouteId()
    {
        if ($dto = $this->getConditionalRoute()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RetailAccountDto | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountDto $retailAccount = null): self
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return RetailAccountDto | null
     */
    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    /**
     * @return static
     */
    public function setRetailAccountId($id): self
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return mixed | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

}
