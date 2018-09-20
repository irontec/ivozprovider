<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface NotificationTemplateContentRepository extends ObjectRepository, Selectable
{

}
