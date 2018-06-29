<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ApplicationServerRepository extends ObjectRepository, Selectable {}

