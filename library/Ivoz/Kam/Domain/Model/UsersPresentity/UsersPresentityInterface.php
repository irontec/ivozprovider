<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersPresentityInterface
*/
interface UsersPresentityInterface extends EntityInterface
{

    public function getUsername(): string;

    public function getDomain(): string;

    public function getEvent(): string;

    public function getEtag(): string;

    public function getExpires(): int;

    public function getReceivedTime(): int;

    public function getBody(): string;

    public function getSender(): string;

    public function getPriority(): int;

    public function isInitialized(): bool;
}
