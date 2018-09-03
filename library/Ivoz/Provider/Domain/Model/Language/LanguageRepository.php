<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface LanguageRepository extends ObjectRepository, Selectable
{

}
