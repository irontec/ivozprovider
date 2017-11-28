<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface IvrRepository extends ObjectRepository, Selectable {}

