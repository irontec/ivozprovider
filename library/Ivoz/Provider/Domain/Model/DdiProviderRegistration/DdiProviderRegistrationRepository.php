<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DdiProviderRegistrationRepository extends ObjectRepository, Selectable
{

}
