<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface IvrExcludedExtensionRepository extends ObjectRepository, Selectable {}

