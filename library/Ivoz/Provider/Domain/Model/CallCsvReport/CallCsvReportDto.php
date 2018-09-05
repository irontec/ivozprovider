<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;


class CallCsvReportDto extends CallCsvReportDtoAbstract
{
    private $csvPath;

    public function getFileObjects()
    {
        return [
            'csv'
        ];
    }

    /**
     * @return self
     */
    public function setCsvPath(string $path = null)
    {
        $this->csvPath = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getCsvPath()
    {
        return $this->csvPath;
    }
}


