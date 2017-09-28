<?php

namespace Ivoz\Provider\Domain\Model\ChangeHistory;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ChangeHistoryRepository extends ObjectRepository, Selectable {}

