<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrunksDialplanRepository extends ObjectRepository, Selectable {}

