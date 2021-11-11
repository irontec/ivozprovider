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
     * @var string|null
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
    public static function getPropertyMap(string $context = '', string $role = null): array
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

    public function toArray(bool $hideSensitiveData = false): array
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

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setPointsTo(string $pointsTo): static
    {
        $this->pointsTo = $pointsTo;

        return $this;
    }

    public function getPointsTo(): ?string
    {
        return $this->pointsTo;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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

    public function setFriends(?array $friends): static
    {
        $this->friends = $friends;

        return $this;
    }

    public function getFriends(): ?array
    {
        return $this->friends;
    }

    public function setResidentialDevices(?array $residentialDevices): static
    {
        $this->residentialDevices = $residentialDevices;

        return $this;
    }

    public function getResidentialDevices(): ?array
    {
        return $this->residentialDevices;
    }

    public function setTerminals(?array $terminals): static
    {
        $this->terminals = $terminals;

        return $this;
    }

    public function getTerminals(): ?array
    {
        return $this->terminals;
    }
}
