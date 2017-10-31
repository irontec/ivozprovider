<?php

use \IvozProvider\Utils\SizeFormatter;

class IvozProvider_Klear_Ghost_Recordings extends KlearMatrix_Model_Field_Ghost_Abstract {

    /**
     * @param \Ivoz\Domain\Model\Brand\BrandDTO $model
     * @return string
     */
    public function getBrandDiskUsage($model)
    {
        $used = 'Pending'; //SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $limit = $model->getRecordingsLimitMB();
        if ($limit) {
            $limit = SizeFormatter::sizeToHuman($limit);
        } else {
            $limit = _("unlimited");
        }
        return sprintf("%s / %s", $used, $limit);
    }

    /**
     * @param Ivoz\Domain\Model\Company\CompanyDTO $model
     * @return string
     */
    public function getCompanyDiskUsage($model)
    {
        /**
         * @var \Ivoz\Core\Application\Service\DataGateway $dataGateway
         */
        $dataGateway = \Zend_Registry::get('data_gateway');

        $used = 'Pending'; //SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $companyLimit = $model->getRecordingsLimitMB();

        /**
         * @var \Ivoz\Domain\Model\Brand\BrandDTO $brand
         */
        $brand = $dataGateway->find('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $model->getBrandId());
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
