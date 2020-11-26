<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersHtableDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersHtableDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $keyName = '';

    /**
     * @var int
     */
    private $keyType = 0;

    /**
     * @var int
     */
    private $valueType = 0;

    /**
     * @var string
     */
    private $keyValue = '';

    /**
     * @var int
     */
    private $expires = 0;

    /**
     * @var int
     */
    private $id;

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
            'keyName' => 'keyName',
            'keyType' => 'keyType',
            'valueType' => 'valueType',
            'keyValue' => 'keyValue',
            'expires' => 'expires',
            'id' => 'id'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $keyName | null
     *
     * @return static
     */
    public function setKeyName(?string $keyName = null): self
    {
        $this->keyName = $keyName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getKeyName(): ?string
    {
        return $this->keyName;
    }

    /**
     * @param int $keyType | null
     *
     * @return static
     */
    public function setKeyType(?int $keyType = null): self
    {
        $this->keyType = $keyType;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getKeyType(): ?int
    {
        return $this->keyType;
    }

    /**
     * @param int $valueType | null
     *
     * @return static
     */
    public function setValueType(?int $valueType = null): self
    {
        $this->valueType = $valueType;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getValueType(): ?int
    {
        return $this->valueType;
    }

    /**
     * @param string $keyValue | null
     *
     * @return static
     */
    public function setKeyValue(?string $keyValue = null): self
    {
        $this->keyValue = $keyValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getKeyValue(): ?string
    {
        return $this->keyValue;
    }

    /**
     * @param int $expires | null
     *
     * @return static
     */
    public function setExpires(?int $expires = null): self
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getExpires(): ?int
    {
        return $this->expires;
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

}
