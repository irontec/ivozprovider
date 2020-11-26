<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressDto;

/**
* TrunksAddressDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksAddressDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $grp = 1;

    /**
     * @var string | null
     */
    private $ipAddr;

    /**
     * @var int
     */
    private $mask = 32;

    /**
     * @var int
     */
    private $port = 0;

    /**
     * @var string | null
     */
    private $tag;

    /**
     * @var int
     */
    private $id;

    /**
     * @var DdiProviderAddressDto | null
     */
    private $ddiProviderAddress;

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
            'grp' => 'grp',
            'ipAddr' => 'ipAddr',
            'mask' => 'mask',
            'port' => 'port',
            'tag' => 'tag',
            'id' => 'id',
            'ddiProviderAddressId' => 'ddiProviderAddress'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'grp' => $this->getGrp(),
            'ipAddr' => $this->getIpAddr(),
            'mask' => $this->getMask(),
            'port' => $this->getPort(),
            'tag' => $this->getTag(),
            'id' => $this->getId(),
            'ddiProviderAddress' => $this->getDdiProviderAddress()
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
     * @param int $grp | null
     *
     * @return static
     */
    public function setGrp(?int $grp = null): self
    {
        $this->grp = $grp;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getGrp(): ?int
    {
        return $this->grp;
    }

    /**
     * @param string $ipAddr | null
     *
     * @return static
     */
    public function setIpAddr(?string $ipAddr = null): self
    {
        $this->ipAddr = $ipAddr;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIpAddr(): ?string
    {
        return $this->ipAddr;
    }

    /**
     * @param int $mask | null
     *
     * @return static
     */
    public function setMask(?int $mask = null): self
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMask(): ?int
    {
        return $this->mask;
    }

    /**
     * @param int $port | null
     *
     * @return static
     */
    public function setPort(?int $port = null): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param string $tag | null
     *
     * @return static
     */
    public function setTag(?string $tag = null): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
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
     * @param DdiProviderAddressDto | null
     *
     * @return static
     */
    public function setDdiProviderAddress(?DdiProviderAddressDto $ddiProviderAddress = null): self
    {
        $this->ddiProviderAddress = $ddiProviderAddress;

        return $this;
    }

    /**
     * @return DdiProviderAddressDto | null
     */
    public function getDdiProviderAddress(): ?DdiProviderAddressDto
    {
        return $this->ddiProviderAddress;
    }

    /**
     * @return static
     */
    public function setDdiProviderAddressId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderAddressDto($id)
            : null;

        return $this->setDdiProviderAddress($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderAddressId()
    {
        if ($dto = $this->getDdiProviderAddress()) {
            return $dto->getId();
        }

        return null;
    }

}
