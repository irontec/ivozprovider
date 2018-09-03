<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RatingProfileRepository extends ObjectRepository, Selectable
{

}
