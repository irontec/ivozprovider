<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocation;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationDto;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;

class IvozProvider_Klear_Ghost_SchedulerSuccess extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /** @var \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerDto $model */
    public function getCallCsvSchedulerLastExecutionReport($model)
    {
        $errorMsg = $model->getLastExecutionError();
        $lastExecution = $model->getLastExecution();

        return $this->getlastExecutionReport(
            $lastExecution,
            $errorMsg
        );
    }

    /** @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto $model */
    public function getInvoiceSchedulerLastExecutionReport($model)
    {
        $errorMsg = $model->getLastExecutionError();
        $lastExecution = $model->getLastExecution();

        return $this->getlastExecutionReport(
            $lastExecution,
            $errorMsg
        );
    }

    /**
     * @param $lastExecution
     * @param $errorMsg
     * @return string
     */
    private function getlastExecutionReport(\DateTime $lastExecution = null, string $errorMsg = null): string
    {
        if (!$lastExecution) {
            return '';
        }
        $lastExecutionStr = $lastExecution->format('Y-m-d H:i:s');

        if (empty($errorMsg)) {

            $response =
                $lastExecutionStr
                . ' <span class="ui-silk inline ui-silk-tick" title="Successful execution"></span>';

            return $response;
        }

        $response =
            $lastExecutionStr
            . ' <span class="ui-silk inline ui-silk-exclamation" title="'
            . $errorMsg
            . '"></span>';

        return $response;
    }
}
