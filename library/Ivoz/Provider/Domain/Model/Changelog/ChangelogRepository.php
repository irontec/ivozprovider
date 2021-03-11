<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ChangelogRepository extends ObjectRepository, Selectable
{

}
