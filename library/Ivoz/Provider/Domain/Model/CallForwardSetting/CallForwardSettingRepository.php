<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallForwardSettingRepository extends ObjectRepository, Selectable {}

