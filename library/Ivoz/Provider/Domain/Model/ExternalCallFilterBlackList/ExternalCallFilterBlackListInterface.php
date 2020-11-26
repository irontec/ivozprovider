<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExternalCallFilterBlackListInterface
*/
interface ExternalCallFilterBlackListInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterBlackListInterface;

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface;

    /**
     * Get matchlist
     *
     * @return MatchListInterface
     */
    public function getMatchlist(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
