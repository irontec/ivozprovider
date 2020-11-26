<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;

/**
* DomainDtoAbstract
* @codeCoverageIgnore
*/
abstract class DomainDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $pointsTo = 'proxyusers';

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var FriendDto[] | null
     */
    private $friends;

    /**
     * @var ResidentialDeviceDto[] | null
     */
    private $residentialDevices;

    /**
     * @var TerminalDto[] | null
     */
    private $terminals;

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
        $response = [
            'domain' => $this->getDomain(),
            'pointsTo' => $this->getPointsTo(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'friends' => $this->getFriends(),
            'residentialDevices' => $this->getResidentialDevices(),
            'terminals' => $this->getTerminals()
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
     * @param string $domain | null
     *
     * @return static
     */
    public function setDomain(?string $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $pointsTo | null
     *
     * @return static
     */
    public function setPointsTo(?string $pointsTo = null): self
    {
        $this->pointsTo = $pointsTo;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPointsTo(): ?string
    {
        return $this->pointsTo;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
     * @param FriendDto[] | null
     *
     * @return static
     */
    public function setFriends(?array $friends = null): self
    {
        $this->friends = $friends;

        return $this;
    }

    /**
     * @return FriendDto[] | null
     */
    public function getFriends(): ?array
    {
        return $this->friends;
    }

    /**
     * @param ResidentialDeviceDto[] | null
     *
     * @return static
     */
    public function setResidentialDevices(?array $residentialDevices = null): self
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    /**
     * @return ResidentialDeviceDto[] | null
     */
    public function getResidentialDevices(): ?array
    {
        return $this->residentialDevices;
    }

    /**
     * @param TerminalDto[] | null
     *
     * @return static
     */
    public function setTerminals(?array $terminals = null): self
    {
        $this->terminals = $terminals;

        return $this;
    }

    /**
     * @return TerminalDto[] | null
     */
    public function getTerminals(): ?array
    {
        return $this->terminals;
    }

}
