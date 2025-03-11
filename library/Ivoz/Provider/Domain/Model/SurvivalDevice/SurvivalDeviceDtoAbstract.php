<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* SurvivalDeviceDtoAbstract
* @codeCoverageIgnore
*/
abstract class SurvivalDeviceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $proxy = null;

    /**
     * @var string|null
     */
    private $outboundProxy = null;

    /**
     * @var int|null
     */
    private $udpPort = 5060;

    /**
     * @var int|null
     */
    private $tcpPort = 5060;

    /**
     * @var int|null
     */
    private $tlsPort = 5061;

    /**
     * @var int|null
     */
    private $wssPort = 10081;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    public function __construct(?int $id = null)
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
            'name' => 'name',
            'proxy' => 'proxy',
            'outboundProxy' => 'outboundProxy',
            'udpPort' => 'udpPort',
            'tcpPort' => 'tcpPort',
            'tlsPort' => 'tlsPort',
            'wssPort' => 'wssPort',
            'description' => 'description',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'proxy' => $this->getProxy(),
            'outboundProxy' => $this->getOutboundProxy(),
            'udpPort' => $this->getUdpPort(),
            'tcpPort' => $this->getTcpPort(),
            'tlsPort' => $this->getTlsPort(),
            'wssPort' => $this->getWssPort(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'company' => $this->getCompany()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setProxy(string $proxy): static
    {
        $this->proxy = $proxy;

        return $this;
    }

    public function getProxy(): ?string
    {
        return $this->proxy;
    }

    public function setOutboundProxy(?string $outboundProxy): static
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    public function setUdpPort(int $udpPort): static
    {
        $this->udpPort = $udpPort;

        return $this;
    }

    public function getUdpPort(): ?int
    {
        return $this->udpPort;
    }

    public function setTcpPort(int $tcpPort): static
    {
        $this->tcpPort = $tcpPort;

        return $this;
    }

    public function getTcpPort(): ?int
    {
        return $this->tcpPort;
    }

    public function setTlsPort(int $tlsPort): static
    {
        $this->tlsPort = $tlsPort;

        return $this;
    }

    public function getTlsPort(): ?int
    {
        return $this->tlsPort;
    }

    public function setWssPort(int $wssPort): static
    {
        $this->wssPort = $wssPort;

        return $this;
    }

    public function getWssPort(): ?int
    {
        return $this->wssPort;
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

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }
}
