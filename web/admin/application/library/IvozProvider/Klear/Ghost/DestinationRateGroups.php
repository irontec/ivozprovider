<?php

use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class IvozProvider_Klear_Ghost_DestinationRateGroups extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param DestinationRateGroupDto $destinationRateGroup
     * @return string
     */
    public function getStatus($destinationRateGroup)
    {
        $status = $destinationRateGroup->getStatus();
        if ($status === DestinationRateGroupInterface::STATUS_ERROR) {
            $response = Klear_Model_Gettext::gettextCheck(
                '_("Error")'
            );

            $errorMsg =
                '<span class="ui-silk inline ui-silk-exclamation" title="'
                . $destinationRateGroup->getLastExecutionError()
                . '"></span>';

            return $errorMsg . ' ' . $response;
        }

        switch ($status) {
            case DestinationRateGroupInterface::STATUS_IMPORTED:
                return Klear_Model_Gettext::gettextCheck(
                    '_("Imported")'
                );

            case DestinationRateGroupInterface::STATUS_INPROGRESS:
                return Klear_Model_Gettext::gettextCheck(
                    '_("In progress")'
                );

            case DestinationRateGroupInterface::STATUS_WAITING:
                return Klear_Model_Gettext::gettextCheck(
                    '_("Waiting")'
                );
        }
    }
}
