<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;

/**
* ExtensionDtoAbstract
* @codeCoverageIgnore
*/
abstract class ExtensionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $number = null;

    /**
     * @var string|null
     */
    private $routeType = null;

    /**
     * @var string|null
     */
    private $numberValue = null;

    /**
     * @var string|null
     */
    private $friendValue = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var IvrDto | null
     */
    private $ivr = null;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup = null;

    /**
     * @var ConferenceRoomDto | null
     */
    private $conferenceRoom = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var QueueDto | null
     */
    private $queue = null;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute = null;

    /**
     * @var CountryDto | null
     */
    private $numberCountry = null;

    /**
     * @var VoicemailDto | null
     */
    private $voicemail = null;

    /**
     * @var UserDto[] | null
     */
    private $users = null;

    /**
     * @param string|int|null $id
     */
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
            'number' => 'number',
            'routeType' => 'routeType',
            'numberValue' => 'numberValue',
            'friendValue' => 'friendValue',
            'id' => 'id',
            'companyId' => 'company',
            'ivrId' => 'ivr',
            'huntGroupId' => 'huntGroup',
            'conferenceRoomId' => 'conferenceRoom',
            'userId' => 'user',
            'queueId' => 'queue',
            'conditionalRouteId' => 'conditionalRoute',
            'numberCountryId' => 'numberCountry',
            'voicemailId' => 'voicemail'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'number' => $this->getNumber(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'friendValue' => $this->getFriendValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'ivr' => $this->getIvr(),
            'huntGroup' => $this->getHuntGroup(),
            'conferenceRoom' => $this->getConferenceRoom(),
            'user' => $this->getUser(),
            'queue' => $this->getQueue(),
            'conditionalRoute' => $this->getConditionalRoute(),
            'numberCountry' => $this->getNumberCountry(),
            'voicemail' => $this->getVoicemail(),
            'users' => $this->getUsers()
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

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
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

    public function setNumberValue(?string $numberValue): static
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
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

    public function setNumberCountry(?CountryDto $numberCountry): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    public function setNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoicemail(?VoicemailDto $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailDto
    {
        return $this->voicemail;
    }

    public function setVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setVoicemail($value);
    }

    public function getVoicemailId()
    {
        if ($dto = $this->getVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUsers(?array $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
    * @return UserDto[] | null
    */
    public function getUsers(): ?array
    {
        return $this->users;
    }
}
