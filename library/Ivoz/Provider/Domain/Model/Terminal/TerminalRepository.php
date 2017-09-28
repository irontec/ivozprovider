<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TerminalRepository extends ObjectRepository, Selectable {}

