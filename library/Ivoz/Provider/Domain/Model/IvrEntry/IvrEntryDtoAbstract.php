<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* IvrEntryDtoAbstract
* @codeCoverageIgnore
*/
abstract class IvrEntryDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $entry;

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
     * @var IvrDto | null
     */
    private $ivr;

    /**
     * @var LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var ExtensionDto | null
     */
    private $extension;

    /**
     * @var UserDto | null
     */
    private $voiceMailUser;

    /**
     * @var ConditionalRouteDto | null
     */
    private $conditionalRoute;

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
            'entry' => 'entry',
            'routeType' => 'routeType',
            'numberValue' => 'numberValue',
            'id' => 'id',
            'ivrId' => 'ivr',
            'welcomeLocutionId' => 'welcomeLocution',
            'extensionId' => 'extension',
            'voiceMailUserId' => 'voiceMailUser',
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
            'entry' => $this->getEntry(),
            'routeType' => $this->getRouteType(),
            'numberValue' => $this->getNumberValue(),
            'id' => $this->getId(),
            'ivr' => $this->getIvr(),
            'welcomeLocution' => $this->getWelcomeLocution(),
            'extension' => $this->getExtension(),
            'voiceMailUser' => $this->getVoiceMailUser(),
            'conditionalRoute' => $this->getConditionalRoute(),
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
     * @param string $entry | null
     *
     * @return static
     */
    public function setEntry(?string $entry = null): self
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntry(): ?string
    {
        return $this->entry;
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
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setWelcomeLocution(?LocutionDto $welcomeLocution = null): self
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getWelcomeLocution(): ?LocutionDto
    {
        return $this->welcomeLocution;
    }

    /**
     * @return static
     */
    public function setWelcomeLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setWelcomeLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getWelcomeLocutionId()
    {
        if ($dto = $this->getWelcomeLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setExtension(?ExtensionDto $extension = null): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    /**
     * @return static
     */
    public function setExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setVoiceMailUser(?UserDto $voiceMailUser = null): self
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getVoiceMailUser(): ?UserDto
    {
        return $this->voiceMailUser;
    }

    /**
     * @return static
     */
    public function setVoiceMailUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setVoiceMailUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getVoiceMailUserId()
    {
        if ($dto = $this->getVoiceMailUser()) {
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

}
