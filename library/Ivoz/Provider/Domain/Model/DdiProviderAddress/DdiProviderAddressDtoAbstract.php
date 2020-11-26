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
     * @var string | null
     */
    private $ip;

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider;

    /**
     * @var TrunksAddressDto | null
     */
    private $trunksAddress;

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
            'ip' => 'ip',
            'description' => 'description',
            'id' => 'id',
            'ddiProviderId' => 'ddiProvider',
            'trunksAddressId' => 'trunksAddress'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $ip | null
     *
     * @return static
     */
    public function setIp(?string $ip = null): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
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
     * @param DdiProviderDto | null
     *
     * @return static
     */
    public function setDdiProvider(?DdiProviderDto $ddiProvider = null): self
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return DdiProviderDto | null
     */
    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    /**
     * @return static
     */
    public function setDdiProviderId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksAddressDto | null
     *
     * @return static
     */
    public function setTrunksAddress(?TrunksAddressDto $trunksAddress = null): self
    {
        $this->trunksAddress = $trunksAddress;

        return $this;
    }

    /**
     * @return TrunksAddressDto | null
     */
    public function getTrunksAddress(): ?TrunksAddressDto
    {
        return $this->trunksAddress;
    }

    /**
     * @return static
     */
    public function setTrunksAddressId($id): self
    {
        $value = !is_null($id)
            ? new TrunksAddressDto($id)
            : null;

        return $this->setTrunksAddress($value);
    }

    /**
     * @return mixed | null
     */
    public function getTrunksAddressId()
    {
        if ($dto = $this->getTrunksAddress()) {
            return $dto->getId();
        }

        return null;
    }

}
