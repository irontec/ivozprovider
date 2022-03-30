<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface InvoiceTemplateRepository extends ObjectRepository, Selectable
{
}
