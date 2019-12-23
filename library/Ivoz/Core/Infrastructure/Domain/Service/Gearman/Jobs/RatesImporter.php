<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

class RatesImporter extends AbstractJob
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
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
