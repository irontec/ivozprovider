<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

interface IvrRepository extends ObjectRepository, Selectable
{
    public function findByExtension(ExtensionInterface $extension);

    public function findByUser(UserInterface $user);
}
