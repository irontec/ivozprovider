<?php

use \IvozProvider\Utils\SizeFormatter;

class IvozProvider_Klear_Ghost_Recordings extends KlearMatrix_Model_Field_Ghost_Abstract {

    public function getBrandDiskUsage($model)
    {
        $used = SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $limit = $model->getRecordingsLimit();
        if ($limit) {
            $limit = SizeFormatter::sizeToHuman($limit);
        } else {
            $limit = _("unlimited");
        }
        return sprintf("%s / %s", $used, $limit);
    }

    public function getCompanyDiskUsage($model)
    {
        $used = SizeFormatter::sizeToHuman($model->getRecordingsDiskUsage());
        $companyLimit = $model->getRecordingsLimit();
        $brand = $model->getBrand();
        $brandLimit = $brand->getRecordingsLimit();

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
