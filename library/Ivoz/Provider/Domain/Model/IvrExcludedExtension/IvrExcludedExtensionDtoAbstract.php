<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;

/**
* IvrExcludedExtensionDtoAbstract
* @codeCoverageIgnore
*/
abstract class IvrExcludedExtensionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var IvrDto | null
     */
    private $ivr;

    /**
     * @var ExtensionDto | null
     */
    private $extension;

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
            'id' => 'id',
            'ivrId' => 'ivr',
            'extensionId' => 'extension'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'ivr' => $this->getIvr(),
            'extension' => $this->getExtension()
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
     * @param IvrDto | null
     *
     * @return static
     */
    public function setIvr(?IvrDto $ivr = null): self
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * @return IvrDto | null
     */
    public function getIvr(): ?IvrDto
    {
        return $this->ivr;
    }

    /**
     * @return static
     */
    public function setIvrId($id): self
    {
        $value = !is_null($id)
            ? new IvrDto($id)
            : null;

        return $this->setIvr($value);
    }

    /**
     * @return mixed | null
     */
    public function getIvrId()
    {
        if ($dto = $this->getIvr()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setExtension(?ExtensionDto $extension = null): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    /**
     * @return static
     */
    public function setExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

}
