<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersHtableInterface
*/
interface UsersHtableInterface extends EntityInterface
{

    public function getKeyName(): string;

    public function getKeyType(): int;

    public function getValueType(): int;

    public function getKeyValue(): string;

    public function getExpires(): int;

    public function isInitialized(): bool;
}
