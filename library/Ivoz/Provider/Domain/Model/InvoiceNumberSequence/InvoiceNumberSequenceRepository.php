<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface InvoiceNumberSequenceRepository extends  ObjectRepository, Selectable
{

}


