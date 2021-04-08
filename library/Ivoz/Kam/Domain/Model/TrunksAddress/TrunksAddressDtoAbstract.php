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
     * @var string|null
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
     * @var string|null
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

    public function setGrp(?int $grp): static
    {
        $this->grp = $grp;

        return $this;
    }

    public function getGrp(): ?int
    {
        return $this->grp;
    }

    public function setIpAddr(?string $ipAddr): static
    {
        $this->ipAddr = $ipAddr;

        return $this;
    }

    public function getIpAddr(): ?string
    {
        return $this->ipAddr;
    }

    public function setMask(?int $mask): static
    {
        $this->mask = $mask;

        return $this;
    }

    public function getMask(): ?int
    {
        return $this->mask;
    }

    public function setPort(?int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDdiProviderAddress(?DdiProviderAddressDto $ddiProviderAddress): static
    {
        $this->ddiProviderAddress = $ddiProviderAddress;

        return $this;
    }

    public function getDdiProviderAddress(): ?DdiProviderAddressDto
    {
        return $this->ddiProviderAddress;
    }

    public function setDdiProviderAddressId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderAddressDto($id)
            : null;

        return $this->setDdiProviderAddress($value);
    }

    public function getDdiProviderAddressId()
    {
        if ($dto = $this->getDdiProviderAddress()) {
            return $dto->getId();
        }

        return null;
    }
}
