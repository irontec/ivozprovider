<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface NotificationTemplateContentRepository extends ObjectRepository, Selectable
{
}
