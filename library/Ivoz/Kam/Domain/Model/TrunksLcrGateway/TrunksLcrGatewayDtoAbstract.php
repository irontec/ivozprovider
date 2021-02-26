<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;

/**
* TrunksLcrGatewayDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksLcrGatewayDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $lcrId = 1;

    /**
     * @var string
     */
    private $gwName = '';

    /**
     * @var string|null
     */
    private $ip;

    /**
     * @var string|null
     */
    private $hostname;

    /**
     * @var int|null
     */
    private $port;

    /**
     * @var string|null
     */
    private $params;

    /**
     * @var int|null
     */
    private $uriScheme;

    /**
     * @var int|null
     */
    private $transport;

    /**
     * @var bool|null
     */
    private $strip;

    /**
     * @var string|null
     */
    private $prefix;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var int|null
     */
    private $defunct;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CarrierServerDto | null
     */
    private $carrierServer;

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
            'lcrId' => 'lcrId',
            'gwName' => 'gwName',
            'ip' => 'ip',
            'hostname' => 'hostname',
            'port' => 'port',
            'params' => 'params',
            'uriScheme' => 'uriScheme',
            'transport' => 'transport',
            'strip' => 'strip',
            'prefix' => 'prefix',
            'tag' => 'tag',
            'defunct' => 'defunct',
            'id' => 'id',
            'carrierServerId' => 'carrierServer'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'lcrId' => $this->getLcrId(),
            'gwName' => $this->getGwName(),
            'ip' => $this->getIp(),
            'hostname' => $this->getHostname(),
            'port' => $this->getPort(),
            'params' => $this->getParams(),
            'uriScheme' => $this->getUriScheme(),
            'transport' => $this->getTransport(),
            'strip' => $this->getStrip(),
            'prefix' => $this->getPrefix(),
            'tag' => $this->getTag(),
            'defunct' => $this->getDefunct(),
            'id' => $this->getId(),
            'carrierServer' => $this->getCarrierServer()
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

    public function setLcrId(?int $lcrId): static
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    public function setGwName(?string $gwName): static
    {
        $this->gwName = $gwName;

        return $this;
    }

    public function getGwName(): ?string
    {
        return $this->gwName;
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

    public function setHostname(?string $hostname): static
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
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

    public function setParams(?string $params): static
    {
        $this->params = $params;

        return $this;
    }

    public function getParams(): ?string
    {
        return $this->params;
    }

    public function setUriScheme(?int $uriScheme): static
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    public function setTransport(?int $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?int
    {
        return $this->transport;
    }

    public function setStrip(?bool $strip): static
    {
        $this->strip = $strip;

        return $this;
    }

    public function getStrip(): ?bool
    {
        return $this->strip;
    }

    public function setPrefix(?string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
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

    public function setDefunct(?int $defunct): static
    {
        $this->defunct = $defunct;

        return $this;
    }

    public function getDefunct(): ?int
    {
        return $this->defunct;
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

    public function setCarrierServer(?CarrierServerDto $carrierServer): static
    {
        $this->carrierServer = $carrierServer;

        return $this;
    }

    public function getCarrierServer(): ?CarrierServerDto
    {
        return $this->carrierServer;
    }

    public function setCarrierServerId($id): static
    {
        $value = !is_null($id)
            ? new CarrierServerDto($id)
            : null;

        return $this->setCarrierServer($value);
    }

    public function getCarrierServerId()
    {
        if ($dto = $this->getCarrierServer()) {
            return $dto->getId();
        }

        return null;
    }

}
