<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;

interface RemoveTpAccountActionInterface
{
    /**
     * @param TpAccountActionInterface $accountAction
     * @return void
     * @throws \DomainException
     */
    public function execute(TpAccountActionInterface $accountAction);
}
