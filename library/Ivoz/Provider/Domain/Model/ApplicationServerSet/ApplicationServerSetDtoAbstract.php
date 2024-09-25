<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerDto;

/**
* ApplicationServerSetDtoAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = '';

    /**
     * @var string|null
     */
    private $distributeMethod = 'hash';

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var ApplicationServerSetRelApplicationServerDto[] | null
     */
    private $relApplicationServers = null;

    public function __construct(?int $id = null)
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
            'name' => 'name',
            'distributeMethod' => 'distributeMethod',
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
            'name' => $this->getName(),
            'distributeMethod' => $this->getDistributeMethod(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'relApplicationServers' => $this->getRelApplicationServers()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDistributeMethod(string $distributeMethod): static
    {
        $this->distributeMethod = $distributeMethod;

        return $this;
    }

    public function getDistributeMethod(): ?string
    {
        return $this->distributeMethod;
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

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param ApplicationServerSetRelApplicationServerDto[] | null $relApplicationServers
     */
    public function setRelApplicationServers(?array $relApplicationServers): static
    {
        $this->relApplicationServers = $relApplicationServers;

        return $this;
    }

    /**
    * @return ApplicationServerSetRelApplicationServerDto[] | null
    */
    public function getRelApplicationServers(): ?array
    {
        return $this->relApplicationServers;
    }
}
