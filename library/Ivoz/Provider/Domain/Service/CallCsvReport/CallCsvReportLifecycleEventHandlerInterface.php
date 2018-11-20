<?php

namespace Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;

interface CallCsvReportLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(CallCsvReportInterface $entity);
}
