<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* ExtensionDtoAbstract
* @codeCoverageIgnore
*/
abstract class ExtensionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string | null
     */
    private $routeType;

    /**
     * @var string | null
     */
    private $numberValue;

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
     * @var IvrDto | null
     */
    private $ivr;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup;

    /**
     * @var ConferenceRoomDto | null
     */
    private $conferenceRoom;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var QueueDto | null
     */
    private $queue;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute;

    /**
     * @var CountryDto | null
     */
    private $numberCountry;

    /**
     * @var UserDto[] | null
     */
    private $users;

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
            'numberCountryId' => 'numberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $number | null
     *
     * @return static
     */
    public function setNumber(?string $number = null): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumber(): ?string
    {
        return $this->number;
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
     * @param string $numberValue | null
     *
     * @return static
     */
    public function setNumberValue(?string $numberValue = null): self
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberValue(): ?string
    {
        return $this->numberValue;
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
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNumberCountry(?CountryDto $numberCountry = null): self
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    /**
     * @return static
     */
    public function setNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto[] | null
     *
     * @return static
     */
    public function setUsers(?array $users = null): self
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
