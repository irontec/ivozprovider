<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;

/**
* TpDestinationDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpDestinationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var \DateTimeInterface|string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var DestinationDto | null
     */
    private $destination;

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
            'tpid' => 'tpid',
            'tag' => 'tag',
            'prefix' => 'prefix',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'destinationId' => 'destination'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'prefix' => $this->getPrefix(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'destination' => $this->getDestination()
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

    public function setTpid(string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setCreatedAt(\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
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

    public function setDestination(?DestinationDto $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDestination(): ?DestinationDto
    {
        return $this->destination;
    }

    public function setDestinationId($id): static
    {
        $value = !is_null($id)
            ? new DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }
}
