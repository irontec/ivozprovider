<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface LanguageRepository extends ObjectRepository, Selectable
{

}
