<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RecordingRepository extends ObjectRepository, Selectable
{

}
