<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
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
     * @var string|null
     */
    private $domain = null;

    /**
     * @var string|null
     */
    private $pointsTo = 'proxyusers';

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var FriendDto[] | null
     */
    private $friends = null;

    /**
     * @var ResidentialDeviceDto[] | null
     */
    private $residentialDevices = null;

    /**
     * @var TerminalDto[] | null
     */
    private $terminals = null;

    /**
     * @param string|int|null $id
     */
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

    /**
     * @return array<string, mixed>
     */
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFriends(?array $friends): static
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

    public function setResidentialDevices(?array $residentialDevices): static
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

    public function setTerminals(?array $terminals): static
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
