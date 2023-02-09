<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface IvrExcludedExtensionRepository extends ObjectRepository, Selectable
{
}
