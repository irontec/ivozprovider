<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class HuntGroupDtoAbstract implements DataTransferObjectInterface
{
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
     * @var integer
     */
    private $ringAllTimeout;

    /**
     * @var integer
     */
    private $nextUserPosition = '0';

    /**
     * @var string
     */
    private $noAnswerTargetType;

    /**
     * @var string
     */
    private $noAnswerNumberValue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $noAnswerLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $noAnswerExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $noAnswerVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $noAnswerNumberCountry;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserDto[] | null
     */
    private $huntGroupsRelUsers = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'description' => 'description',
            'strategy' => 'strategy',
            'ringAllTimeout' => 'ringAllTimeout',
            'nextUserPosition' => 'nextUserPosition',
            'noAnswerTargetType' => 'noAnswerTargetType',
            'noAnswerNumberValue' => 'noAnswerNumberValue',
            'id' => 'id',
            'company' => 'company',
            'noAnswerLocution' => 'noAnswerLocution',
            'noAnswerExtension' => 'noAnswerExtension',
            'noAnswerVoiceMailUser' => 'noAnswerVoiceMailUser',
            'noAnswerNumberCountry' => 'noAnswerNumberCountry'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'strategy' => $this->getStrategy(),
            'ringAllTimeout' => $this->getRingAllTimeout(),
            'nextUserPosition' => $this->getNextUserPosition(),
            'noAnswerTargetType' => $this->getNoAnswerTargetType(),
            'noAnswerNumberValue' => $this->getNoAnswerNumberValue(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'noAnswerLocution' => $this->getNoAnswerLocution(),
            'noAnswerExtension' => $this->getNoAnswerExtension(),
            'noAnswerVoiceMailUser' => $this->getNoAnswerVoiceMailUser(),
            'noAnswerNumberCountry' => $this->getNoAnswerNumberCountry(),
            'huntGroupsRelUsers' => $this->getHuntGroupsRelUsers()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->noAnswerLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getNoAnswerLocutionId());
        $this->noAnswerExtension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getNoAnswerExtensionId());
        $this->noAnswerVoiceMailUser = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getNoAnswerVoiceMailUserId());
        $this->noAnswerNumberCountry = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Country\\Country', $this->getNoAnswerNumberCountryId());
        if (!is_null($this->huntGroupsRelUsers)) {
            $items = $this->getHuntGroupsRelUsers();
            $this->huntGroupsRelUsers = [];
            foreach ($items as $item) {
                $this->huntGroupsRelUsers[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\HuntGroupsRelUser\\HuntGroupsRelUser',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->huntGroupsRelUsers = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\HuntGroupsRelUser\\HuntGroupsRelUser',
            $this->huntGroupsRelUsers
        );
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $strategy
     *
     * @return static
     */
    public function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param integer $ringAllTimeout
     *
     * @return static
     */
    public function setRingAllTimeout($ringAllTimeout = null)
    {
        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRingAllTimeout()
    {
        return $this->ringAllTimeout;
    }

    /**
     * @param integer $nextUserPosition
     *
     * @return static
     */
    public function setNextUserPosition($nextUserPosition = null)
    {
        $this->nextUserPosition = $nextUserPosition;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNextUserPosition()
    {
        return $this->nextUserPosition;
    }

    /**
     * @param string $noAnswerTargetType
     *
     * @return static
     */
    public function setNoAnswerTargetType($noAnswerTargetType = null)
    {
        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoAnswerTargetType()
    {
        return $this->noAnswerTargetType;
    }

    /**
     * @param string $noAnswerNumberValue
     *
     * @return static
     */
    public function setNoAnswerNumberValue($noAnswerNumberValue = null)
    {
        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoAnswerNumberValue()
    {
        return $this->noAnswerNumberValue;
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setCompanyId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
                : null;

            return $this->setCompany($value);
        }

        /**
         * @return integer | null
         */
        public function getCompanyId()
        {
            if ($dto = $this->getCompany()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $noAnswerLocution
     *
     * @return static
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $noAnswerLocution = null)
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setNoAnswerLocutionId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
                : null;

            return $this->setNoAnswerLocution($value);
        }

        /**
         * @return integer | null
         */
        public function getNoAnswerLocutionId()
        {
            if ($dto = $this->getNoAnswerLocution()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noAnswerExtension
     *
     * @return static
     */
    public function setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $noAnswerExtension = null)
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getNoAnswerExtension()
    {
        return $this->noAnswerExtension;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setNoAnswerExtensionId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
                : null;

            return $this->setNoAnswerExtension($value);
        }

        /**
         * @return integer | null
         */
        public function getNoAnswerExtensionId()
        {
            if ($dto = $this->getNoAnswerExtension()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $noAnswerVoiceMailUser
     *
     * @return static
     */
    public function setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserDto $noAnswerVoiceMailUser = null)
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getNoAnswerVoiceMailUser()
    {
        return $this->noAnswerVoiceMailUser;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setNoAnswerVoiceMailUserId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
                : null;

            return $this->setNoAnswerVoiceMailUser($value);
        }

        /**
         * @return integer | null
         */
        public function getNoAnswerVoiceMailUserId()
        {
            if ($dto = $this->getNoAnswerVoiceMailUser()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $noAnswerNumberCountry
     *
     * @return static
     */
    public function setNoAnswerNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $noAnswerNumberCountry = null)
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getNoAnswerNumberCountry()
    {
        return $this->noAnswerNumberCountry;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setNoAnswerNumberCountryId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
                : null;

            return $this->setNoAnswerNumberCountry($value);
        }

        /**
         * @return integer | null
         */
        public function getNoAnswerNumberCountryId()
        {
            if ($dto = $this->getNoAnswerNumberCountry()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param array $huntGroupsRelUsers
     *
     * @return static
     */
    public function setHuntGroupsRelUsers($huntGroupsRelUsers = null)
    {
        $this->huntGroupsRelUsers = $huntGroupsRelUsers;

        return $this;
    }

    /**
     * @return array
     */
    public function getHuntGroupsRelUsers()
    {
        return $this->huntGroupsRelUsers;
    }
}


