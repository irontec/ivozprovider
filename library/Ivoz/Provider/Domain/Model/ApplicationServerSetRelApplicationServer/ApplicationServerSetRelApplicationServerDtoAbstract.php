<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetDto;

/**
* ApplicationServerSetRelApplicationServerDtoAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetRelApplicationServerDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var ApplicationServerDto | null
     */
    private $applicationServer = null;

    /**
     * @var ApplicationServerSetDto | null
     */
    private $applicationServerSet = null;

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
            'id' => 'id',
            'applicationServerId' => 'applicationServer',
            'applicationServerSetId' => 'applicationServerSet'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'id' => $this->getId(),
            'applicationServer' => $this->getApplicationServer(),
            'applicationServerSet' => $this->getApplicationServerSet()
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

    public function setApplicationServer(?ApplicationServerDto $applicationServer): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ?ApplicationServerDto
    {
        return $this->applicationServer;
    }

    public function setApplicationServerId(?int $id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerDto($id)
            : null;

        return $this->setApplicationServer($value);
    }

    public function getApplicationServerId(): ?int
    {
        if ($dto = $this->getApplicationServer()) {
            return $dto->getId();
        }

        return null;
    }

    public function setApplicationServerSet(?ApplicationServerSetDto $applicationServerSet): static
    {
        $this->applicationServerSet = $applicationServerSet;

        return $this;
    }

    public function getApplicationServerSet(): ?ApplicationServerSetDto
    {
        return $this->applicationServerSet;
    }

    public function setApplicationServerSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerSetDto($id)
            : null;

        return $this->setApplicationServerSet($value);
    }

    public function getApplicationServerSetId(): ?int
    {
        if ($dto = $this->getApplicationServerSet()) {
            return $dto->getId();
        }

        return null;
    }
}
