<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use IvozProvider\Utils\SizeFormatter;

class IvozProvider_Klear_Ghost_Companies extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param CompanyDto $model
     * @return string
     */
    public function getTypeIcon($model)
    {
        switch($model->getType()) {
            case Company::VPBX:
                return '<span class="ui-silk inline ui-silk-building" title="Company"></span>';
            case Company::RETAIL:
                return '<span class="ui-silk inline ui-silk-basket" title="Retail"></span>';
            default:
                return $model->getType();
        }
    }
}
