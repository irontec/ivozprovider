<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class IvrEntryDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $entry;

    /**
     * @var string
     */
    private $routeType;

    /**
     * @var string
     */
    private $numberValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrDto | null
     */
    private $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $welcomeLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $voiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto | null
     */
    private $conditionalRoute;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $numberCountry;


    use DtoNormalizer;

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
     * @param string $entry
     *
     * @return static
     */
    public function setEntry($entry = null)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param string $routeType
     *
     * @return static
     */
    public function setRouteType($routeType = null)
    {
        $this->routeType = $routeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * @param string $numberValue
     *
     * @return static
     */
    public function setNumberValue($numberValue = null)
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrDto $ivr
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrDto $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrDto | null
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setIvrId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ivr\IvrDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution
     *
     * @return static
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $welcomeLocution = null)
    {
        $this->welcomeLocution = $welcomeLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    public function getWelcomeLocution()
    {
        return $this->welcomeLocution;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setWelcomeLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $extension
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $voiceMailUser
     *
     * @return static
     */
    public function setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $voiceMailUser = null)
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    public function getVoiceMailUser()
    {
        return $this->voiceMailUser;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setVoiceMailUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto $conditionalRoute
     *
     * @return static
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto | null
     */
    public function getConditionalRoute()
    {
        return $this->conditionalRoute;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setConditionalRouteId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $numberCountry
     *
     * @return static
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
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
