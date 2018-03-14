<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use IvozProvider\Utils\SizeFormatter;

class IvozProvider_Klear_Ghost_NotificationTemplate extends KlearMatrix_Model_Field_Ghost_Abstract
{
    public function getVoicemailVariables($model)
    {
        return null;
    }

    public function getFaxVariables($model)
    {
        return null;
    }
}
