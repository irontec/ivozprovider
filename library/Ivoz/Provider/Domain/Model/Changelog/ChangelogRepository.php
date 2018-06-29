<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ChangelogRepository extends ObjectRepository, Selectable {}

