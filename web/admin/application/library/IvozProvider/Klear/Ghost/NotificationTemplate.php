<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use IvozProvider\Utils\SizeFormatter;

/**
 * Class IvozProvider_Klear_Ghost_NotificationTemplate
 *
 * This ghost field enables a readonly fieald that is not handled by the ORM
 *
 * This way we can create dummy fields with attached help information to customize each notification screen
 * with it's proper variables informarmation.
 *
 */
class IvozProvider_Klear_Ghost_NotificationTemplate extends KlearMatrix_Model_Field_Ghost_Abstract
{
    public function getVariables($model)
    {
        // The return value doesn't matter for this dummy ghost field
        return null;
    }
}
