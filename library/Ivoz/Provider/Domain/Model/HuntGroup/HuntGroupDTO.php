<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class HuntGroupDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $noAnswerLocutionId;

    /**
     * @var mixed
     */
    private $noAnswerExtensionId;

    /**
     * @var mixed
     */
    private $noAnswerVoiceMailUserId;

    /**
     * @var mixed
     */
    private $noAnswerNumberCountryId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $noAnswerLocution;

    /**
     * @var mixed
     */
    private $noAnswerExtension;

    /**
     * @var mixed
     */
    private $noAnswerVoiceMailUser;

    /**
     * @var mixed
     */
    private $noAnswerNumberCountry;

    /**
     * @var array|null
     */
    private $huntGroupsRelUsers = null;

    /**
     * @return array
     */
    public function __toArray()
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
            'companyId' => $this->getCompanyId(),
            'noAnswerLocutionId' => $this->getNoAnswerLocutionId(),
            'noAnswerExtensionId' => $this->getNoAnswerExtensionId(),
            'noAnswerVoiceMailUserId' => $this->getNoAnswerVoiceMailUserId(),
            'noAnswerNumberCountryId' => $this->getNoAnswerNumberCountryId(),
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
     * @return HuntGroupDTO
     */
    public function setName($name)
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
     * @return HuntGroupDTO
     */
    public function setDescription($description)
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
     * @return HuntGroupDTO
     */
    public function setStrategy($strategy)
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
     * @return HuntGroupDTO
     */
    public function setRingAllTimeout($ringAllTimeout)
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
     * @return HuntGroupDTO
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
     * @return HuntGroupDTO
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
     * @return HuntGroupDTO
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
     * @return HuntGroupDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return HuntGroupDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $noAnswerLocutionId
     *
     * @return HuntGroupDTO
     */
    public function setNoAnswerLocutionId($noAnswerLocutionId)
    {
        $this->noAnswerLocutionId = $noAnswerLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerLocutionId()
    {
        return $this->noAnswerLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

    /**
     * @param integer $noAnswerExtensionId
     *
     * @return HuntGroupDTO
     */
    public function setNoAnswerExtensionId($noAnswerExtensionId)
    {
        $this->noAnswerExtensionId = $noAnswerExtensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerExtensionId()
    {
        return $this->noAnswerExtensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getNoAnswerExtension()
    {
        return $this->noAnswerExtension;
    }

    /**
     * @param integer $noAnswerVoiceMailUserId
     *
     * @return HuntGroupDTO
     */
    public function setNoAnswerVoiceMailUserId($noAnswerVoiceMailUserId)
    {
        $this->noAnswerVoiceMailUserId = $noAnswerVoiceMailUserId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerVoiceMailUserId()
    {
        return $this->noAnswerVoiceMailUserId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getNoAnswerVoiceMailUser()
    {
        return $this->noAnswerVoiceMailUser;
    }

    /**
     * @param integer $noAnswerNumberCountryId
     *
     * @return HuntGroupDTO
     */
    public function setNoAnswerNumberCountryId($noAnswerNumberCountryId)
    {
        $this->noAnswerNumberCountryId = $noAnswerNumberCountryId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNoAnswerNumberCountryId()
    {
        return $this->noAnswerNumberCountryId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\Country
     */
    public function getNoAnswerNumberCountry()
    {
        return $this->noAnswerNumberCountry;
    }

    /**
     * @param array $huntGroupsRelUsers
     *
     * @return HuntGroupDTO
     */
    public function setHuntGroupsRelUsers($huntGroupsRelUsers)
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


