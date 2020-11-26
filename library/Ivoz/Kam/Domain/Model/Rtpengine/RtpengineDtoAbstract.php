<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto;

/**
* RtpengineDtoAbstract
* @codeCoverageIgnore
*/
abstract class RtpengineDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $setid = 0;

    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $weight = 1;

    /**
     * @var bool
     */
    private $disabled = false;

    /**
     * @var \DateTimeInterface
     */
    private $stamp = '2000-01-01 00:00:00';

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySet;

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
            'setid' => 'setid',
            'url' => 'url',
            'weight' => 'weight',
            'disabled' => 'disabled',
            'stamp' => 'stamp',
            'description' => 'description',
            'id' => 'id',
            'mediaRelaySetId' => 'mediaRelaySet'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'setid' => $this->getSetid(),
            'url' => $this->getUrl(),
            'weight' => $this->getWeight(),
            'disabled' => $this->getDisabled(),
            'stamp' => $this->getStamp(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'mediaRelaySet' => $this->getMediaRelaySet()
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
     * @param int $setid | null
     *
     * @return static
     */
    public function setSetid(?int $setid = null): self
    {
        $this->setid = $setid;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSetid(): ?int
    {
        return $this->setid;
    }

    /**
     * @param string $url | null
     *
     * @return static
     */
    public function setUrl(?string $url = null): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param int $weight | null
     *
     * @return static
     */
    public function setWeight(?int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param bool $disabled | null
     *
     * @return static
     */
    public function setDisabled(?bool $disabled = null): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param \DateTimeInterface $stamp | null
     *
     * @return static
     */
    public function setStamp($stamp = null): self
    {
        $this->stamp = $stamp;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getStamp()
    {
        return $this->stamp;
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
     * @param MediaRelaySetDto | null
     *
     * @return static
     */
    public function setMediaRelaySet(?MediaRelaySetDto $mediaRelaySet = null): self
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    /**
     * @return MediaRelaySetDto | null
     */
    public function getMediaRelaySet(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySet;
    }

    /**
     * @return static
     */
    public function setMediaRelaySetId($id): self
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySet($value);
    }

    /**
     * @return mixed | null
     */
    public function getMediaRelaySetId()
    {
        if ($dto = $this->getMediaRelaySet()) {
            return $dto->getId();
        }

        return null;
    }

}
