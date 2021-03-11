<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface RatingProfileRepository extends ObjectRepository, Selectable
{

}
