<?php

namespace Ivoz\Provider\Domain\Model\IvrCustom;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface IvrCustomRepository extends ObjectRepository, Selectable {}

