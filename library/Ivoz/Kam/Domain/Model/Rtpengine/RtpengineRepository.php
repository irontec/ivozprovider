<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RtpengineRepository extends ObjectRepository, Selectable {}

