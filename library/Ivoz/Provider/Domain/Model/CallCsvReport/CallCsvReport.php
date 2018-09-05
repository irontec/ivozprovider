<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

/**
 * CallCsvReport
 */
class CallCsvReport extends CallCsvReportAbstract implements CallCsvReportInterface
{
    use CallCsvReportTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

