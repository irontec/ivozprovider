<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CodecRepository extends ObjectRepository, Selectable
{

}
