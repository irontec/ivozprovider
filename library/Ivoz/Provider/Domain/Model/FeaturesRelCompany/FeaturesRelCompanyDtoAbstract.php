<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class FeaturesRelCompanyDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Feature\FeatureDto | null
     */
    private $feature;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'companyId' => 'company',
            'featureId' => 'feature'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'feature' => $this->getFeature()
        ];
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Feature\FeatureDto $feature
     *
     * @return static
     */
    public function setFeature(\Ivoz\Provider\Domain\Model\Feature\FeatureDto $feature = null)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureDto
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFeatureId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Feature\FeatureDto($id)
            : null;

        return $this->setFeature($value);
    }

    /**
     * @return integer | null
     */
    public function getFeatureId()
    {
        if ($dto = $this->getFeature()) {
            return $dto->getId();
        }

        return null;
    }
}
