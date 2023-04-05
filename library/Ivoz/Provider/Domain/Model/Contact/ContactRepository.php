<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ContactRepository extends ObjectRepository, Selectable
{
}
