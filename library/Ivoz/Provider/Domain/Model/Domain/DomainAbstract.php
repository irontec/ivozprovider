<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * DomainAbstract
 * @codeCoverageIgnore
 */
abstract class DomainAbstract
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $scope = 'global';

    /**
     * @var string
     */
    protected $pointsTo = 'proxyusers';

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($domain, $scope, $pointsTo)
    {
        $this->setDomain($domain);
        $this->setScope($scope);
        $this->setPointsTo($pointsTo);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    public function getChangeSet()
    {
        return array_diff(
            $this->_initialValues,
            $this->__toArray()
        );
    }

    /**
     * @return DomainDTO
     */
    public static function createDTO()
    {
        return new DomainDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDTO
         */
        Assertion::isInstanceOf($dto, DomainDTO::class);

        $self = new static(
            $dto->getDomain(),
            $dto->getScope(),
            $dto->getPointsTo());

        return $self
            ->setDescription($dto->getDescription())
            ->setCompany($dto->getCompany())
            ->setBrand($dto->getBrand())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDTO
         */
        Assertion::isInstanceOf($dto, DomainDTO::class);

        $this
            ->setDomain($dto->getDomain())
            ->setScope($dto->getScope())
            ->setPointsTo($dto->getPointsTo())
            ->setDescription($dto->getDescription())
            ->setCompany($dto->getCompany())
            ->setBrand($dto->getBrand());


        return $this;
    }

    /**
     * @return DomainDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setDomain($this->getDomain())
            ->setScope($this->getScope())
            ->setPointsTo($this->getPointsTo())
            ->setDescription($this->getDescription())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'domain' => self::getDomain(),
            'scope' => self::getScope(),
            'pointsTo' => self::getPointsTo(),
            'description' => self::getDescription(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain)
    {
        Assertion::notNull($domain);
        Assertion::maxLength($domain, 190);

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set scope
     *
     * @param string $scope
     *
     * @return self
     */
    public function setScope($scope)
    {
        Assertion::notNull($scope);

        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set pointsTo
     *
     * @param string $pointsTo
     *
     * @return self
     */
    public function setPointsTo($pointsTo)
    {
        Assertion::notNull($pointsTo);

        $this->pointsTo = $pointsTo;

        return $this;
    }

    /**
     * Get pointsTo
     *
     * @return string
     */
    public function getPointsTo()
    {
        return $this->pointsTo;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 500);
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }



    // @codeCoverageIgnoreEnd
}

