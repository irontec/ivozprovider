<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;

/**
* CompanyServiceDtoAbstract
* @codeCoverageIgnore
*/
abstract class CompanyServiceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var ServiceDto | null
     */
    private $service;

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
            'code' => 'code',
            'id' => 'id',
            'companyId' => 'company',
            'serviceId' => 'service'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'code' => $this->getCode(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'service' => $this->getService()
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
     * @param string $code | null
     *
     * @return static
     */
    public function setCode(?string $code = null): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCode(): ?string
    {
        return $this->code;
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

    /**
     * @param ServiceDto | null
     *
     * @return static
     */
    public function setService(?ServiceDto $service = null): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return ServiceDto | null
     */
    public function getService(): ?ServiceDto
    {
        return $this->service;
    }

    /**
     * @return static
     */
    public function setServiceId($id): self
    {
        $value = !is_null($id)
            ? new ServiceDto($id)
            : null;

        return $this->setService($value);
    }

    /**
     * @return mixed | null
     */
    public function getServiceId()
    {
        if ($dto = $this->getService()) {
            return $dto->getId();
        }

        return null;
    }

}
