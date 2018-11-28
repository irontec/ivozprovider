<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * CallCsvReport
 */
class CallCsvReport extends CallCsvReportAbstract implements FileContainerInterface, CallCsvReportInterface
{
    use CallCsvReportTrait;
    use TempFileContainnerTrait;

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

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'Csv'
        ];
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone()
    {
        $timeZone = $this->getBrand()
            ? $this->getBrand()->getDefaultTimezone()
            : $this->getCompany()->getDefaultTimezone();

        return $timeZone;
    }
}
