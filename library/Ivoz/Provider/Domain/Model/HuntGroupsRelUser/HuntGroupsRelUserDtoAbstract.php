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
     * @var int|null
     */
    private $timeoutTime;

    /**
     * @var int|null
     */
    private $priority;

    /**
     * @var string
     */
    private $routeType = '';

    /**
     * @var string|null
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

    public function setTimeoutTime(?int $timeoutTime): static
    {
        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    public function getTimeoutTime(): ?int
    {
        return $this->timeoutTime;
    }

    public function setPriority(?int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
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

}
