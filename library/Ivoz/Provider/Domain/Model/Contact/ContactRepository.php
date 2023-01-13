<?php

namespace Ivoz\Provider\Domain\Model\Contact;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ContactRepository extends ObjectRepository, Selectable
{

}
