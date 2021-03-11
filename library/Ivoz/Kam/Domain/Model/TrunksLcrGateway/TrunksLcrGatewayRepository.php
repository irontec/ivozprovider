<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TrunksLcrGatewayRepository extends ObjectRepository, Selectable
{
    public function findDummyGateway();
}
