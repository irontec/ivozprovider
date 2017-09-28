<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * FeaturesRelCompanyAbstract
 * @codeCoverageIgnore
 */
abstract class FeaturesRelCompanyAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    protected $feature;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct()
    {


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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return FeaturesRelCompanyDTO
     */
    public static function createDTO()
    {
        return new FeaturesRelCompanyDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FeaturesRelCompanyDTO
         */
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDTO::class);

        $self = new static();

        return $self
            ->setCompany($dto->getCompany())
            ->setFeature($dto->getFeature())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FeaturesRelCompanyDTO
         */
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDTO::class);

        $this
            ->setCompany($dto->getCompany())
            ->setFeature($dto->getFeature());


        return $this;
    }

    /**
     * @return FeaturesRelCompanyDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setFeatureId($this->getFeature() ? $this->getFeature()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null,
            'featureId' => $this->getFeature() ? $this->getFeature()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

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
     * Set feature
     *
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature
     *
     * @return self
     */
    public function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureInterface $feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface
     */
    public function getFeature()
    {
        return $this->feature;
    }



    // @codeCoverageIgnoreEnd
}

