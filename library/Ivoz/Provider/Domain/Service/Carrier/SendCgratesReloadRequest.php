<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

class SendCgratesReloadRequest extends CgratesReloadNotificator implements CarrierLifecycleEventHandlerInterface
{

    protected $tpAccountActionRepository;

    public function __construct(
        TpAccountActionRepository $tpAccountActionRepository,
        RaterReloadInterface $cgratesReloadJob
    ) {
        $this->tpAccountActionRepository = $tpAccountActionRepository;
        parent::__construct($cgratesReloadJob);
    }

    /**
     * @return void
     */
    public function execute(CarrierInterface $carrier)
    {
        if (!$carrier->isNew()) {
            return;
        }

        $tpAccountAction = $this
            ->tpAccountActionRepository
            ->findByCarrier(
                $carrier->getId()
            );

        if (!$tpAccountAction) {
            return;
        }

        $this->reload(
            $tpAccountAction->getTpid()
        );
    }
}
