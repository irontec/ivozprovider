<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PeerServerRepository extends ObjectRepository, Selectable {}

