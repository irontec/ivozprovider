<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface DdiProviderRegistrationRepository extends ObjectRepository, Selectable
{
}
