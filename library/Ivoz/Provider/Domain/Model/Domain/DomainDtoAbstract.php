<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DomainDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $pointsTo = 'proxyusers';

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendDto[] | null
     */
    private $friends = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto[] | null
     */
    private $residentialDevices = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto[] | null
     */
    private $terminals = null;


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
            'domain' => 'domain',
            'pointsTo' => 'pointsTo',
            'description' => 'description',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'domain' => $this->getDomain(),
            'pointsTo' => $this->getPointsTo(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'friends' => $this->getFriends(),
            'residentialDevices' => $this->getResidentialDevices(),
            'terminals' => $this->getTerminals()
        ];
    }

    /**
     * @param string $domain
     *
     * @return static
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $pointsTo
     *
     * @return static
     */
    public function setPointsTo($pointsTo = null)
    {
        $this->pointsTo = $pointsTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPointsTo()
    {
        return $this->pointsTo;
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
     * @param array $friends
     *
     * @return static
     */
    public function setFriends($friends = null)
    {
        $this->friends = $friends;

        return $this;
    }

    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param array $residentialDevices
     *
     * @return static
     */
    public function setResidentialDevices($residentialDevices = null)
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    /**
     * @return array
     */
    public function getResidentialDevices()
    {
        return $this->residentialDevices;
    }

    /**
     * @param array $terminals
     *
     * @return static
     */
    public function setTerminals($terminals = null)
    {
        $this->terminals = $terminals;

        return $this;
    }

    /**
     * @return array
     */
    public function getTerminals()
    {
        return $this->terminals;
    }
}
