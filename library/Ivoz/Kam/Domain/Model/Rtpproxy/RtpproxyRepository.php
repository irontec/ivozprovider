<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RtpproxyRepository extends ObjectRepository, Selectable {}

