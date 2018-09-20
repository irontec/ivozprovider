<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CodecRepository extends ObjectRepository, Selectable
{

}
