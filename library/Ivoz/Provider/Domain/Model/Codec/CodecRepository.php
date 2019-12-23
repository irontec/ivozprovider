<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CodecRepository extends ObjectRepository, Selectable
{

}
