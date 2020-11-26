<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* TrunksDomainAttrDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksDomainAttrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $did;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \DateTimeInterface
     */
    private $lastModified = '1900-01-01 00:00:01';

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
            'did' => 'did',
            'name' => 'name',
            'type' => 'type',
            'value' => 'value',
            'lastModified' => 'lastModified',
            'id' => 'id'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'did' => $this->getDid(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'lastModified' => $this->getLastModified(),
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
     * @param string $did | null
     *
     * @return static
     */
    public function setDid(?string $did = null): self
    {
        $this->did = $did;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDid(): ?string
    {
        return $this->did;
    }

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param int $type | null
     *
     * @return static
     */
    public function setType(?int $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param string $value | null
     *
     * @return static
     */
    public function setValue(?string $value = null): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param \DateTimeInterface $lastModified | null
     *
     * @return static
     */
    public function setLastModified($lastModified = null): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastModified()
    {
        return $this->lastModified;
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
