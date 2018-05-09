<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;


interface CompanyRelCodecRepository extends ObjectRepository, Selectable {}

