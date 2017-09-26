<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class CompanyServiceDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $serviceId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $service;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'code' => $this->getCode(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'serviceId' => $this->getServiceId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->service = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Service\\Service', $this->getServiceId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $code
     *
     * @return CompanyServiceDTO
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param integer $id
     *
     * @return CompanyServiceDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $companyId
     *
     * @return CompanyServiceDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $serviceId
     *
     * @return CompanyServiceDTO
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Service\Service
     */
    public function getService()
    {
        return $this->service;
    }
}

