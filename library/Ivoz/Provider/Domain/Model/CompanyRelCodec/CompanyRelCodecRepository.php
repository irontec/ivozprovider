<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CompanyRelCodecRepository extends ObjectRepository, Selectable
{
}
