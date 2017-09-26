<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PsEndpointRepository extends ObjectRepository, Selectable {}

