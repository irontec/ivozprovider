<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* UsersAddressDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersAddressDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $sourceAddress;

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
     * @var string | null
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

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
            'sourceAddress' => 'sourceAddress',
            'ipAddr' => 'ipAddr',
            'mask' => 'mask',
            'port' => 'port',
            'tag' => 'tag',
            'description' => 'description',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'sourceAddress' => $this->getSourceAddress(),
            'ipAddr' => $this->getIpAddr(),
            'mask' => $this->getMask(),
            'port' => $this->getPort(),
            'tag' => $this->getTag(),
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

    /**
     * @param string $sourceAddress | null
     *
     * @return static
     */
    public function setSourceAddress(?string $sourceAddress = null): self
    {
        $this->sourceAddress = $sourceAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSourceAddress(): ?string
    {
        return $this->sourceAddress;
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
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

}
