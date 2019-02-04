<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use IvozProvider\Utils\SizeFormatter;

class IvozProvider_Klear_Ghost_Recordings extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     * @param BrandDto $model
     * @return string
     */
    public function getBrandDiskUsage($model)
    {
        /** @todo Implement used disk value */
        return 'Not yet implemented';

        $used = SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $limit = $model->getRecordingsLimitMB();
        if ($limit) {
            $limit = SizeFormatter::sizeToHuman($limit);
        } else {
            $limit = _("unlimited");
        }
        return sprintf("%s / %s", $used, $limit);
    }

    /**
     * @param CompanyDto $model
     * @return string
     * @throws Zend_Exception
     */
    public function getCompanyDiskUsage($model)
    {
        /**
         * @var DataGateway $dataGateway
         */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @todo Implement used disk value */
        return 'Not yet implemented';
        $used = SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $companyLimit = $model->getRecordingsLimitMB();

        /**
         * @var BrandDto $brand
         */
        $brand = $dataGateway->find(Brand::class, $model->getBrandId());
        $brandLimit = $brand->getRecordingsLimitMB();

        if ($companyLimit) {
            $limit = SizeFormatter::sizeToHuman($companyLimit);
            if ($brandLimit !== 0 && $companyLimit > $brandLimit) {
                $limit .= " (" . _("oversized") . ")";
            }
        } else {
            if ($brandLimit) {
                $limit = SizeFormatter::sizeToHuman($brandLimit);
                $limit .= " (" . _("shared") . ")";
            } else {
                $limit = _("unlimited");
            }
        }

        return sprintf("%s / %s", $used, $limit);
    }
}
