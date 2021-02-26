<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TrunksHtableInterface
*/
interface TrunksHtableInterface extends EntityInterface
{

    public function getKeyName(): string;

    public function getKeyType(): int;

    public function getValueType(): int;

    public function getKeyValue(): string;

    public function getExpires(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
