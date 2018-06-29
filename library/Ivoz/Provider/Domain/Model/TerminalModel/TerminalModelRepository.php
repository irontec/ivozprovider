<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TerminalModelRepository extends ObjectRepository, Selectable {}

