<?php

namespace Ivoz\Provider\Domain\Model\CompanyAdmin;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CompanyAdminRepository extends ObjectRepository, Selectable {}

