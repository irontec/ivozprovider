<?php

namespace Ivoz\Provider\Infrastructure\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\AbstractJob;
use Ivoz\Provider\Domain\Job\RatesImporterJobInterface;

class RatesImporter extends AbstractJob implements RatesImporterJobInterface
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $method = "WorkerRates~import";

    /**
     * @var array
     */
    protected $mainVariables = array(
        'params',
    );

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
