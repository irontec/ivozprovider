<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;
use Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto;

/**
* DdiProviderAddressDtoAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderAddressDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $ip = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider = null;

    /**
     * @var TrunksAddressDto | null
     */
    private $trunksAddress = null;

    /**
     * @param string|int|null $id
     */
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
            'ip' => 'ip',
            'description' => 'description',
            'id' => 'id',
            'ddiProviderId' => 'ddiProvider',
            'trunksAddressId' => 'trunksAddress'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'ip' => $this->getIp(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'ddiProvider' => $this->getDdiProvider(),
            'trunksAddress' => $this->getTrunksAddress()
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

    public function setIp(?string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDdiProvider(?DdiProviderDto $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    public function setDdiProviderId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTrunksAddress(?TrunksAddressDto $trunksAddress): static
    {
        $this->trunksAddress = $trunksAddress;

        return $this;
    }

    public function getTrunksAddress(): ?TrunksAddressDto
    {
        return $this->trunksAddress;
    }

    public function setTrunksAddressId($id): static
    {
        $value = !is_null($id)
            ? new TrunksAddressDto($id)
            : null;

        return $this->setTrunksAddress($value);
    }

    public function getTrunksAddressId()
    {
        if ($dto = $this->getTrunksAddress()) {
            return $dto->getId();
        }

        return null;
    }
}
