<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BrandServiceRepository extends ObjectRepository, Selectable {}

