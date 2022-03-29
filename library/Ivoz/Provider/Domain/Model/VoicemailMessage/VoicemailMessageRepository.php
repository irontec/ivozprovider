<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface VoicemailMessageRepository extends ObjectRepository, Selectable
{

}
