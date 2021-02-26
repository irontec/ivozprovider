<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersPuaInterface
*/
interface UsersPuaInterface extends EntityInterface
{

    public function getPresUri(): string;

    public function getPresId(): string;

    public function getEvent(): int;

    public function getExpires(): int;

    public function getDesiredExpires(): int;

    public function getFlag(): int;

    public function getEtag(): string;

    public function getTupleId(): ?string;

    public function getWatcherUri(): string;

    public function getCallId(): string;

    public function getToTag(): string;

    public function getFromTag(): string;

    public function getCseq(): int;

    public function getRecordRoute(): ?string;

    public function getContact(): string;

    public function getRemoteContact(): string;

    public function getVersion(): int;

    public function getExtraHeaders(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
