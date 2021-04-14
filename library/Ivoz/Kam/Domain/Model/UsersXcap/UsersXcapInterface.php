<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersXcapInterface
*/
interface UsersXcapInterface extends EntityInterface
{

    public function getUsername(): string;

    public function getDomain(): string;

    public function getDoc(): string;

    public function getDocType(): int;

    public function getEtag(): string;

    public function getSource(): int;

    public function getDocUri(): string;

    public function getPort(): int;

    public function isInitialized(): bool;
}
