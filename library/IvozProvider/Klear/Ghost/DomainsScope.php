<?php

class IvozProvider_Klear_Ghost_DomainsScope extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model Domains model
     * @return name of target based on domain scope
     */
    public function getData ($model)
    {
        $domainScope = $model->getScope();

        if ($domainScope == 'global') {
            return 'Global';
        } else if ($domainScope == 'company') {

            $dataGateway = \Zend_Registry::get('data_gateway');
            $company = $dataGateway->find('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $model->getCompanyId());
            $companyName = $company->getName() . ' (company)';

            return $companyName;

        } elseif ($domainScope == 'brand') {

            $dataGateway = \Zend_Registry::get('data_gateway');
            $brand = $dataGateway->find('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $model->getBrandId());
            $brandName = $brand->getName() . ' (company)';

            return $brandName;

        } else {

            // Outgoing Route with unexpected Type
            return null;
        }
    }
}
