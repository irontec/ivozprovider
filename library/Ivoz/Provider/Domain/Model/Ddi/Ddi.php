<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

/**
 * Ddi
 */
class Ddi extends DdiAbstract implements DdiInterface
{
    use DdiTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string Domain
     */
    public function getDomain()
    {
        /**
         * @var CompanyInterface $company
         */
        $company = $this->getCompany();
        if(!$company) {

            return null;
        }

        /**
         * @var Brand $brand
         */
        $brand = $company->getBrand();
        if(!$brand) {

            return null;
        }

        /**
         * @todo this does not exist
         */
        return $brand->getDomain();
    }

    public function getLanguageCode()
    {
        /**
         * @var Language $language
         */
        $language = $this->getLanguage();
        if (!$language) {

            /**
             * @var Company $company
             */
            $company = $this->getCompany();

            return $company->getLanguageCode();
        }

        return $language->getIden();
    }

    public function setRouteType($routeType = null)
    {
        parent::setRouteType($routeType);

        $nullableFields = array(
            'user'          => 'user',
            'IvrCommon'     => 'IvrCommon',
            'IvrCustom'     => 'IvrCustom',
            'huntGroup'     => 'huntGroup',
            'fax'           => 'fax',
            'friend'        => 'friendValue',
            'conferenceRoom' => 'conferenceRoom',
            'queue'         => 'queue',
        );

        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }

        return $this;
    }

    public function getDdie164()
    {
        return
            $this->getCountry()->getCountryCode() .
            $this->getDdi();
    }
}

