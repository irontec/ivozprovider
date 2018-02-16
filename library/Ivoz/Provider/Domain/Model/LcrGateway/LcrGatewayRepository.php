<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface LcrGatewayRepository extends ObjectRepository, Selectable {}

