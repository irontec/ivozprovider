<?php

namespace Ivoz\Ast\Domain\Model\PsAor;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface PsAorRepository extends ObjectRepository, Selectable
{
    public function getSorceryByContact($contact);
}

