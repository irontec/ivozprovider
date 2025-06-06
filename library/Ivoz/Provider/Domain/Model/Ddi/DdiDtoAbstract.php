<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
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
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;

/**
* DdiDtoAbstract
* @codeCoverageIgnore
*/
abstract class DdiDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $ddi = null;

    /**
     * @var string|null
     */
    private $ddie164 = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var string|null
     */
    private $recordCalls = 'none';

    /**
     * @var string|null
     */
    private $displayName = null;

    /**
     * @var string|null
     */
    private $routeType = null;

    /**
     * @var string|null
     */
    private $friendValue = null;

    /**
     * @var string|null
     */
    private $type = 'inout';

    /**
     * @var bool|null
     */
    private $useDdiProviderRoutingTag = true;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var ConferenceRoomDto | null
     */
    private $conferenceRoom = null;

    /**
     * @var LanguageDto | null
     */
    private $language = null;

    /**
     * @var QueueDto | null
     */
    private $queue = null;

    /**
     * @var ExternalCallFilterDto | null
     */
    private $externalCallFilter = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var IvrDto | null
     */
    private $ivr = null;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup = null;

    /**
     * @var FaxDto | null
     */
    private $fax = null;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider = null;

    /**
     * @var CountryDto | null
     */
    private $country = null;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice = null;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute = null;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount = null;

    /**
     * @var RoutingTagDto | null
     */
    private $routingTag = null;

    /**
     * @var RecordingDto[] | null
     */
    private $recordings = null;

    public function __construct(?int $id = null)
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
            'ddi' => 'ddi',
            'ddie164' => 'ddie164',
            'description' => 'description',
            'recordCalls' => 'recordCalls',
            'displayName' => 'displayName',
            'routeType' => 'routeType',
            'friendValue' => 'friendValue',
            'type' => 'type',
            'useDdiProviderRoutingTag' => 'useDdiProviderRoutingTag',
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
            'retailAccountId' => 'retailAccount',
            'routingTagId' => 'routingTag'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'ddi' => $this->getDdi(),
            'ddie164' => $this->getDdie164(),
            'description' => $this->getDescription(),
            'recordCalls' => $this->getRecordCalls(),
            'displayName' => $this->getDisplayName(),
            'routeType' => $this->getRouteType(),
            'friendValue' => $this->getFriendValue(),
            'type' => $this->getType(),
            'useDdiProviderRoutingTag' => $this->getUseDdiProviderRoutingTag(),
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
            'retailAccount' => $this->getRetailAccount(),
            'routingTag' => $this->getRoutingTag(),
            'recordings' => $this->getRecordings()
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

    public function setDdi(string $ddi): static
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setRecordCalls(string $recordCalls): static
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

    public function setFriendValue(?string $friendValue): static
    {
        $this->friendValue = $friendValue;

        return $this;
    }

    public function getFriendValue(): ?string
    {
        return $this->friendValue;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setUseDdiProviderRoutingTag(bool $useDdiProviderRoutingTag): static
    {
        $this->useDdiProviderRoutingTag = $useDdiProviderRoutingTag;

        return $this;
    }

    public function getUseDdiProviderRoutingTag(): ?bool
    {
        return $this->useDdiProviderRoutingTag;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
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

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
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

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
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

    public function setConferenceRoomId(?int $id): static
    {
        $value = !is_null($id)
            ? new ConferenceRoomDto($id)
            : null;

        return $this->setConferenceRoom($value);
    }

    public function getConferenceRoomId(): ?int
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

    public function setLanguageId(?int $id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId(): ?int
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

    public function setQueueId(?int $id): static
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    public function getQueueId(): ?int
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

    public function setExternalCallFilterId(?int $id): static
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setExternalCallFilter($value);
    }

    public function getExternalCallFilterId(): ?int
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

    public function setUserId(?int $id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId(): ?int
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

    public function setIvrId(?int $id): static
    {
        $value = !is_null($id)
            ? new IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    public function getIvrId(): ?int
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

    public function setHuntGroupId(?int $id): static
    {
        $value = !is_null($id)
            ? new HuntGroupDto($id)
            : null;

        return $this->setHuntGroup($value);
    }

    public function getHuntGroupId(): ?int
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

    public function setFaxId(?int $id): static
    {
        $value = !is_null($id)
            ? new FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    public function getFaxId(): ?int
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

    public function setDdiProviderId(?int $id): static
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    public function getDdiProviderId(): ?int
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

    public function setCountryId(?int $id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    public function getCountryId(): ?int
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

    public function setResidentialDeviceId(?int $id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId(): ?int
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

    public function setConditionalRouteId(?int $id): static
    {
        $value = !is_null($id)
            ? new ConditionalRouteDto($id)
            : null;

        return $this->setConditionalRoute($value);
    }

    public function getConditionalRouteId(): ?int
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

    public function setRetailAccountId(?int $id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId(): ?int
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingTag(?RoutingTagDto $routingTag): static
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    public function getRoutingTag(): ?RoutingTagDto
    {
        return $this->routingTag;
    }

    public function setRoutingTagId(?int $id): static
    {
        $value = !is_null($id)
            ? new RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    public function getRoutingTagId(): ?int
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RecordingDto[] | null $recordings
     */
    public function setRecordings(?array $recordings): static
    {
        $this->recordings = $recordings;

        return $this;
    }

    /**
    * @return RecordingDto[] | null
    */
    public function getRecordings(): ?array
    {
        return $this->recordings;
    }
}
