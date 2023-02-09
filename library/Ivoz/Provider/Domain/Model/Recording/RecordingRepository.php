<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RecordingRepository extends ObjectRepository, Selectable
{
}
