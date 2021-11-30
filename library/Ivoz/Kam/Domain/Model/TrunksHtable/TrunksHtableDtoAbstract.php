<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* TrunksHtableDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksHtableDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $keyName = '';

    /**
     * @var int|null
     */
    private $keyType = 0;

    /**
     * @var int|null
     */
    private $valueType = 0;

    /**
     * @var string|null
     */
    private $keyValue = '';

    /**
     * @var int|null
     */
    private $expires = 0;

    /**
     * @var int|null
     */
    private $id = null;

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
            'keyName' => 'keyName',
            'keyType' => 'keyType',
            'valueType' => 'valueType',
            'keyValue' => 'keyValue',
            'expires' => 'expires',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'keyName' => $this->getKeyName(),
            'keyType' => $this->getKeyType(),
            'valueType' => $this->getValueType(),
            'keyValue' => $this->getKeyValue(),
            'expires' => $this->getExpires(),
            'id' => $this->getId()
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

    public function setKeyName(string $keyName): static
    {
        $this->keyName = $keyName;

        return $this;
    }

    public function getKeyName(): ?string
    {
        return $this->keyName;
    }

    public function setKeyType(int $keyType): static
    {
        $this->keyType = $keyType;

        return $this;
    }

    public function getKeyType(): ?int
    {
        return $this->keyType;
    }

    public function setValueType(int $valueType): static
    {
        $this->valueType = $valueType;

        return $this;
    }

    public function getValueType(): ?int
    {
        return $this->valueType;
    }

    public function setKeyValue(string $keyValue): static
    {
        $this->keyValue = $keyValue;

        return $this;
    }

    public function getKeyValue(): ?string
    {
        return $this->keyValue;
    }

    public function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): ?int
    {
        return $this->expires;
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
}
