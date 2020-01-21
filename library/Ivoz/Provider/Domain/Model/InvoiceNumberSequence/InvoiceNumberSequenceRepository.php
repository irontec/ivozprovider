<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface InvoiceNumberSequenceRepository extends ObjectRepository, Selectable
{

}
