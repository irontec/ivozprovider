<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;


interface FaxesInOutRepository extends ObjectRepository, Selectable {}

