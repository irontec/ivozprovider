<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* HuntGroupsRelUserDtoAbstract
* @codeCoverageIgnore
*/
abstract class HuntGroupsRelUserDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int | null
     */
    private $timeoutTime;

    /**
     * @var int | null
     */
    private $priority;

    /**
     * @var string
     */
    private $routeType;

    /**
     * @var string | null
     */
    private $numberValue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var HuntGroupDto | null
     */
    private $huntGroup;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var CountryDto | null
     */
    private $numberCountry;

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
            'timeoutTime' => 'timeoutTime',
            'priority' => 'priority',
            'routeType' => 'routeType',
            'numberValue' => 'numberValue',
            'id' => 'id',
            'huntGroupId' => 'huntGroup',
            'userId' => 'user',
            'numberCountryId' => 'numberCountry'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'timeoutTime' => $this->getTimeoutTime(),
            'priority' => $this->getPriority(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'id' => $this->getId(),
            'huntGroup' => $this->getHuntGroup(),
            'user' => $this->getUser(),
            'numberCountry' => $this->getNumberCountry()
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
     * @param int $timeoutTime | null
     *
     * @return static
     */
    public function setTimeoutTime(?int $timeoutTime = null): self
    {
        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getTimeoutTime(): ?int
    {
        return $this->timeoutTime;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
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

}
