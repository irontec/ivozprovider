<?php

class IvozProvider_Klear_Ghost_DomainsScope extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model Domains
     *            model
     * @return name of target based on domain scope
     */
    public function getData ($model)
    {
        $domainScope = $model->getScope();

        if ($domainScope == 'global') {
            return 'Global';
        } elseif ($domainScope == 'company') {
            return $model->getCompany()->getName() . ' (company)';
        } elseif ($domainScope == 'brand') {
            return $model->getBrand()->getName() . ' (brand)';
        } else {
            // Outgoing Route with unexpected Type
            return null;
        }
    }
}
