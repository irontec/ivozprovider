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
    public function getChangeSet(): array
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
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'Csv' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface|null
     */
    public function getTimezone(): ?\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
    {
        $timeZone = $this->getBrand()
            ? $this->getBrand()->getDefaultTimezone()
            : $this->getCompany()->getDefaultTimezone();

        return $timeZone;
    }
}
