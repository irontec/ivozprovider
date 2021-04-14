<?php

namespace Ivoz\Provider\Infrastructure\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\AbstractJob;
use Ivoz\Provider\Domain\Job\InvoicerJobInterface;

class Invoicer extends AbstractJob implements InvoicerJobInterface
{
    protected $id;

    protected $method = "WorkerInvoices~create";

    protected $mainVariables = array(
        'id',
    );

    public function setId(int|string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
