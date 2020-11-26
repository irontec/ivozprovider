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
    private $gwName;

    /**
     * @var string | null
     */
    private $ip;

    /**
     * @var string | null
     */
    private $hostname;

    /**
     * @var int | null
     */
    private $port;

    /**
     * @var string | null
     */
    private $params;

    /**
     * @var int | null
     */
    private $uriScheme;

    /**
     * @var int | null
     */
    private $transport;

    /**
     * @var bool | null
     */
    private $strip;

    /**
     * @var string | null
     */
    private $prefix;

    /**
     * @var string | null
     */
    private $tag;

    /**
     * @var int | null
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

    /**
     * @param int $lcrId | null
     *
     * @return static
     */
    public function setLcrId(?int $lcrId = null): self
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    /**
     * @param string $gwName | null
     *
     * @return static
     */
    public function setGwName(?string $gwName = null): self
    {
        $this->gwName = $gwName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getGwName(): ?string
    {
        return $this->gwName;
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
     * @param string $hostname | null
     *
     * @return static
     */
    public function setHostname(?string $hostname = null): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
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
     * @param string $params | null
     *
     * @return static
     */
    public function setParams(?string $params = null): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getParams(): ?string
    {
        return $this->params;
    }

    /**
     * @param int $uriScheme | null
     *
     * @return static
     */
    public function setUriScheme(?int $uriScheme = null): self
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    /**
     * @param int $transport | null
     *
     * @return static
     */
    public function setTransport(?int $transport = null): self
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getTransport(): ?int
    {
        return $this->transport;
    }

    /**
     * @param bool $strip | null
     *
     * @return static
     */
    public function setStrip(?bool $strip = null): self
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getStrip(): ?bool
    {
        return $this->strip;
    }

    /**
     * @param string $prefix | null
     *
     * @return static
     */
    public function setPrefix(?string $prefix = null): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
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
     * @param int $defunct | null
     *
     * @return static
     */
    public function setDefunct(?int $defunct = null): self
    {
        $this->defunct = $defunct;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getDefunct(): ?int
    {
        return $this->defunct;
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
     * @param CarrierServerDto | null
     *
     * @return static
     */
    public function setCarrierServer(?CarrierServerDto $carrierServer = null): self
    {
        $this->carrierServer = $carrierServer;

        return $this;
    }

    /**
     * @return CarrierServerDto | null
     */
    public function getCarrierServer(): ?CarrierServerDto
    {
        return $this->carrierServer;
    }

    /**
     * @return static
     */
    public function setCarrierServerId($id): self
    {
        $value = !is_null($id)
            ? new CarrierServerDto($id)
            : null;

        return $this->setCarrierServer($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierServerId()
    {
        if ($dto = $this->getCarrierServer()) {
            return $dto->getId();
        }

        return null;
    }

}
