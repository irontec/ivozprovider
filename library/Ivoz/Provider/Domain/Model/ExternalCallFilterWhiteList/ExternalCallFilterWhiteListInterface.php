<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

/**
* ExternalCallFilterWhiteListInterface
*/
interface ExternalCallFilterWhiteListInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setFilter(?ExternalCallFilterInterface $filter = null): static;

    public function getFilter(): ?ExternalCallFilterInterface;

    public function getMatchlist(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
