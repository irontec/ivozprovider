<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface InvoiceTemplateRepository extends ObjectRepository, Selectable {}

