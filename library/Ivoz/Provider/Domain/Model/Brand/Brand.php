<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;

/**
 * Brand
 */
class Brand extends BrandAbstract implements FileContainerInterface, BrandInterface
{
    use BrandTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'Logo'
        ];
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     * @see BrandAbstract::setDomainUsers
     */
    public function setDomainUsers($domainUsers = null)
    {
        return parent::setDomainUsers(trim($domainUsers));
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {
            return 'en';
        }

        return $language->getIden();
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->getCurrency()->getSymbol();
    }

    /**
     * @return string
     */
    public function getCurrencyIden()
    {
        return $this->getCurrency()->getIden();
    }

    /**
     * Get the size in bytes used by the recordings on this brand
     *
     */
    public function getRecordingsDiskUsage()
    {
        // Get the sum of all the companies usages
        $total = 0;

        foreach ($this->getCompanies() as $company) {
            $total += $company->getRecordingsDiskUsage();
        }

        return $total;
    }

    /**
     * Get the size in bytes for disk usage limit on this brand
     */
    public function getRecordingsLimit()
    {
        return $this->getRecordingsLimitMB() * 1024 * 1024;
    }

    /**
     * @return FeatureInterface[]
     */
    public function getFeatures()
    {
        $features = array();
        foreach ($this->getRelFeatures() as $relFeature) {
            array_push($features, $relFeature->getFeature());
        }

        return $features;
    }

    /**
     * @param $featureId
     * @return bool
     */
    public function hasFeature($featureId)
    {
        foreach ($this->getFeatures() as $feature) {
            if ($feature->getId() == $featureId) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return Brand Cgrates tenant code
     *
     * @return string
     */
    public function getCgrTenant()
    {
        return sprintf(
            "b%d",
            $this->getId()
        );
    }

    public function getServiceByIden(string $iden)
    {
        $service = $this->serviceRepsitory->getByIden($iden);

        $services = $this->getServices(
            CriteriaHelper::fromArray([
                'service' => $service
            ])
        );

        return array_shift($services);
    }
}
