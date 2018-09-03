<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;

interface RemoveTpRatingProfileInterface
{
    /**
     * @param TpRatingProfileInterface $tpRatingProfile
     * @return void
     * @throws \DomainException
     */
    public function execute(TpRatingProfileInterface $tpRatingProfile);
}
